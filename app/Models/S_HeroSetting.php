<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class S_HeroSetting extends Model
{
    protected $table = 's_hero_settings';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'hero_title',
        'hero_description',
        'badge_1_title',
        'badge_1_subtitle',
        'badge_2_title',
        'badge_2_subtitle',
        'badge_3_title',
        'badge_3_subtitle',
        'trust_badge_1',
        'trust_badge_2',
        'trust_badge_3',
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
     * Get single settings row or create default one.
     */
    public static function getSettings()
    {
        try {
            if (! \Illuminate\Support\Facades\Schema::hasTable('s_hero_settings')) {
                return (object) [
                    'hero_title' => 'Wujudkan Kompetensi Global di SMKN 1 Talaga',
                    'hero_description' => 'SMK Negeri 1 Talaga mendidik insan terampil, berkarakter mulia, dan siap kerja yang berbekal kompetensi mutakhir untuk menjawab tantangan dunia industri era digital.',
                    'badge_1_title' => 'PPDB Online',
                    'badge_1_subtitle' => 'Pendaftaran Aktif',
                    'badge_2_title' => '85%+ Terserap',
                    'badge_2_subtitle' => 'Kerja & Kuliah',
                    'badge_3_title' => 'Bina Karakter',
                    'badge_3_subtitle' => 'Mencetak Lulusan Kompeten',
                    'trust_badge_1' => 'Terakreditasi A',
                    'trust_badge_2' => 'Pusat Keunggulan',
                    'trust_badge_3' => 'Sekolah Adiwiyata',
                ];
            }

            $settings = self::first();
            if (! $settings) {
                $settings = self::create([
                    'hero_title' => 'Wujudkan Kompetensi Global di SMKN 1 Talaga',
                    'hero_description' => 'SMK Negeri 1 Talaga mendidik insan terampil, berkarakter mulia, dan siap kerja yang berbekal kompetensi mutakhir untuk menjawab tantangan dunia industri era digital.',
                    'badge_1_title' => 'PPDB Online',
                    'badge_1_subtitle' => 'Pendaftaran Aktif',
                    'badge_2_title' => '85%+ Terserap',
                    'badge_2_subtitle' => 'Kerja & Kuliah',
                    'badge_3_title' => 'Bina Karakter',
                    'badge_3_subtitle' => 'Mencetak Lulusan Kompeten',
                    'trust_badge_1' => 'Terakreditasi A',
                    'trust_badge_2' => 'Pusat Keunggulan',
                    'trust_badge_3' => 'Sekolah Adiwiyata',
                ]);
            }

            return $settings;
        } catch (\Exception $e) {
            return (object) [
                'hero_title' => 'Wujudkan Kompetensi Global di SMKN 1 Talaga',
                'hero_description' => 'SMK Negeri 1 Talaga mendidik insan terampil, berkarakter mulia, dan siap kerja yang berbekal kompetensi mutakhir untuk menjawab tantangan dunia industri era digital.',
                'badge_1_title' => 'PPDB Online',
                'badge_1_subtitle' => 'Pendaftaran Aktif',
                'badge_2_title' => '85%+ Terserap',
                'badge_2_subtitle' => 'Kerja & Kuliah',
                'badge_3_title' => 'Bina Karakter',
                'badge_3_subtitle' => 'Mencetak Lulusan Kompeten',
                'trust_badge_1' => 'Terakreditasi A',
                'trust_badge_2' => 'Pusat Keunggulan',
                'trust_badge_3' => 'Sekolah Adiwiyata',
            ];
        }
    }
}
