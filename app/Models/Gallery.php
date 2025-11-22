<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    const TYPE_PHOTO = 'photo';
    const TYPE_VIDEO = 'video';

    protected $fillable = [
        'id', 'type', 'title', 'description', 'file_path', 'embed_url', 'caption', 'created_by',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Resolve a suitable iframe src for known providers.
     * Supports YouTube and Vimeo normalization. Falls back to the original URL.
     */
    public function getEmbedSrcAttribute()
    {
        $url = $this->embed_url;
        if (empty($url)) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST) ?: '';
        $host = preg_replace('/^www\./', '', strtolower($host));

        // YouTube (youtu.be, youtube.com, m.youtube.com, youtu.be)
        if (str_contains($host, 'youtube') || str_contains($host, 'youtu.be')) {
            // try several patterns to extract the video id
            if (preg_match('#youtu\.be/([^\?&/]+)#i', $url, $m)) {
                $id = $m[1];
            } elseif (preg_match('#[\?&]v=([^\?&/]+)#i', $url, $m)) {
                $id = $m[1];
            } elseif (preg_match('#/embed/([^\?&/]+)#i', $url, $m)) {
                $id = $m[1];
            } elseif (preg_match('#/shorts/([^\?&/]+)#i', $url, $m)) {
                $id = $m[1];
            } else {
                $id = null;
            }

            if (!empty($id)) {
                return 'https://www.youtube.com/embed/' . $id;
            }
        }

        // Vimeo
        if (str_contains($host, 'vimeo.com')) {
            if (preg_match('#vimeo\.com/(?:video/)?(\d+)#i', $url, $m)) {
                return 'https://player.vimeo.com/video/' . $m[1];
            }
        }

        // Fallback: return the original URL (may work for some oEmbed providers)
        return $url;
    }

    /**
     * Return HTML suitable for embedding the item.
     * For Instagram we return a blockquote and include the embed script.
     * For YouTube/Vimeo we return an iframe using embed_src.
     */
    public function getEmbedHtmlAttribute()
    {
        $url = $this->embed_url;
        if (empty($url)) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST) ?: '';
        $host = preg_replace('/^www\./', '', strtolower($host));

        if (str_contains($host, 'instagram.com')) {
            // normalize permalink (strip query params)
            $permalink = preg_replace('/(\?.*)$/', '', $url);
            if (!str_ends_with($permalink, '/')) {
                $permalink .= '/';
            }
            $escaped = e($permalink);
            // Instagram requires a blockquote and their embed.js script
            // Instead of hiding everything (which prevents embed.js from rendering),
            // only hide known unwanted sections and keep the blockquote + core embed
            // structure visible so Instagram's script can replace the blockquote.
            // Keep the blockquote and embed container visible so embed.js can run.
            // Explicitly hide known unwanted child panels while leaving the
            // main Header visible.


            return '<div class="instagram-embed">'  .
                '<blockquote class="instagram-media" data-instgrm-permalink="' . $escaped . '" data-instgrm-version="14"></blockquote>' .
                '<script async defer src="https://www.instagram.com/embed.js"></script>' .

                '</div>';
        }

        if ($this->embed_src) {
            $src = e($this->embed_src);
            return '<iframe src="' . $src . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>';
        }

        return '<a href="' . e($url) . '" target="_blank" rel="noopener">Open link</a>';
    }
}
