@extends('admin.layouts.app')
@section('title', 'Ekstrakulikuler')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Ekstrakulikuler</h5>
                </div>
                <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                    <li
                        class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                        <a href="#!" class="dark:text-zink-200 text-slate-400">Akademik & Kesiswaan</a>
                    </li>
                    <li class="dark:text-zink-100 text-slate-700">
                        Ekstrakulikuler
                    </li>
                </ul>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 flex items-center justify-between gap-2">
                            <h2 class="text-lg font-semibold text-slate-800 dark:text-zink-100">Daftar Ekstrakulikuler</h2>
                            <a href="{{ route('admin.extrakulikuler.create') }}" class="btn bg-custom-500 border-custom-500 text-white hover:text-white hover:bg-custom-600 hover:border-custom-600">
                                Tambah Ekstrakulikuler
                            </a>
                        </div>

                        @if (isset($extracurriculars) && $extracurriculars->count() > 0)
                            <table id="rowBorder" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="p-2 text-left">Nama</th>
                                        <th class="p-2 text-left">Foto</th>
                                        <th class="p-2 text-left">Menu</th>
                                        <th class="p-2 text-left">Status</th>
                                        <th class="p-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="dark:divide-zink-500 divide-y divide-slate-200">
                                    @foreach ($extracurriculars as $ex)
                                        <tr>
                                            <td class="p-2">{{ $ex->name }}</td>
                                            <td class="p-2">
                                                @if ($ex->photo)
                                                    @php
                                                        $photo = $ex->photo;
                                                        if (filter_var($photo, FILTER_VALIDATE_URL)) {
                                                            $photoUrl = $photo;
                                                        } else {
                                                            if (preg_match('#^assets/#', $photo) || preg_match('#^public/assets/#', $photo)) {
                                                                $p = preg_replace('#^public/#', '', $photo);
                                                                $photoUrl = asset($p);
                                                            } else {
                                                                $rel = preg_replace('#^storage/#', '', $photo);
                                                                $photoUrl = route('public.files', ['path' => $rel]);
                                                            }
                                                        }
                                                    @endphp
                                                    <img src="{{ $photoUrl }}" alt="photo" class="h-10 w-10 object-cover rounded border dark:border-zink-500"
                                                        onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                                @else
                                                    <span class="text-xs text-slate-400">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td class="p-2">{{ $ex->menu?->name ?? '-' }}</td>
                                            <td class="p-2">
                                                @if (($ex->approve ?? 'waiting') === 'waiting')
                                                    <span class="rounded bg-yellow-100 px-2 py-1 text-xs text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">Menunggu</span>
                                                @else
                                                    <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-800 dark:bg-green-500/20 dark:text-green-400">Disetujui</span>
                                                @endif
                                            </td>
                                            <td class="p-2">
                                                <div class="flex gap-2">
                                                    @auth
                                                        @if (auth()->user()->email === 'superadmin@smkn1talaga.sch.id')
                                                            <a href="#!"
                                                                data-modal-target="editStatusEkskulModal{{ $ex->id }}"
                                                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                                    data-lucide="check-check" class="size-4"></i></a>
                                                        @endif
                                                    @endauth
                                                    <a href="{{ route('admin.extrakulikuler.show', $ex->id) }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-green-500/20 dark:hover:text-green-500">
                                                        <i data-lucide="eye" class="size-4"></i>
                                                    </a>
                                                    <a href="{{ route('admin.extrakulikuler.edit', $ex->id) }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                                        <i data-lucide="pencil" class="size-4"></i>
                                                    </a>
                                                    <a href="#!" data-modal-target="deleteModal{{ $ex->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-red-500/20 dark:hover:text-red-500">
                                                        <i data-lucide="trash-2" class="size-4"></i>
                                                    </a>
                                                </div>
                                            </td>

                                            <!-- Approve Modal -->
                                            <div id="editStatusEkskulModal{{ $ex->id }}" modal-center=""
                                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                        <div class="flex items-center justify-center size-12 mx-auto rounded-full bg-custom-100 dark:bg-custom-500/20">
                                                            <i data-lucide="check-check" class="size-6 text-custom-500"></i>
                                                        </div>
                                                        <div class="mt-5 text-center">
                                                            <h5 class="mb-1 text-lg font-bold">Ubah Status Persetujuan</h5>
                                                            <p class="text-slate-500 dark:text-zink-200 text-sm">Apakah Anda yakin ingin mengubah status persetujuan untuk ekstrakurikuler <strong>{{ $ex->name }}</strong>?</p>
                                                            <div class="flex justify-center gap-2 mt-6">
                                                                <form action="{{ route('admin.extrakulikuler.approve', $ex->id) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="approve" value="{{ $ex->approve == 'waiting' ? 'approve' : 'waiting' }}">
                                                                    <button type="button" data-modal-close="editStatusEkskulModal{{ $ex->id }}"
                                                                        class="bg-slate-100 text-slate-500 btn hover:bg-slate-200 px-4 py-2 rounded text-sm font-medium mr-2">Batal</button>
                                                                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 px-4 py-2 rounded text-sm font-medium">Ubah Status</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div id="deleteModal{{ $ex->id }}" modal-center=""
                                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAC8VBMVEUAAAD/6u7/cZD/3uL/5+r/T4T9O4T/4ub9RIX/ooz/7/D/noz+PoT/3uP9TYf/XoX/m4z/oY39Tob/oYz/oo39O4T9TYb/po3/n4z/4Ob/3+X/nIz+fon/4eb/nI39Xoj9fIn/8fP9SoX9coj/noz/XYb/6e38R4b/XIf/cIn/ZYj/Rof/6+//cIr/oYz/a4P/7/L+X4f+bYn+QoX/pIz/7vH/noz/8PH/7O7/4ub/oIz/moz/oY3/O4X/cYn/RYX+aIj/5+r9QYX+XYf+cYn+Z4j+i5j9PoT/po3/8vT/ucD/09f+hYr/8vT8R4X8UYb/3uH+ZIn+W4f+cIn/7O/+hIr+VYf+b4j+ZYj+VYb/6Ov9RYX9UIb9bYn9O4T/oIz9Y4f9WIb/gov/bIj/dYr/gYr/pY3/7e//dYr9PoX/pY3/8vL/PID/7/L+hor+hor/8fP/8fP/o43/o43/7O//n4v/n47/nI7/8PL/6+7/6ez/5+v9QIX/7fD9SoX9SIX9RYX9Q4X+YIf/6u7/7/H+g4r+gYr+gIr+for+fYr+cYn9O4T+e4n+a4j+ZYj+VYb9T4b9PYT+eIn9TYb/8vT+dYn+c4n+don+cIj+Zoj+bYj+aIj+XYf+Yof+W4f/xs/+Wof9U4b+V4b/0Nf/ur3+hor+hYr/1Nv/oY39TIb+eon/1t3/3eL/3+T/0dn/y9P/m4z+aoj9Uob+WYf9UYb/ydL/yNH/2+H/ztb/xM7/197/2uD/0tr/zNT/2d//zdX/noz/w83/4eb/oIz/2N//o43/pI3/nYz/uMX/qr7/u8f/pY3/vcn/p7v/wcv/tMP/ssL/r8H/rb//usf/wMv/tcP+kKL+h5f/sr7/o7f/oLT/k6/+mav+kKr+lKH+fqH+bZf+dJb+hJH9X5H+e4z/v8n+iKX+h6H/rL//rbr/mrP/mbD+dp3+fpz+jJv+fpf9ZJT+e5D+aZD/qbf+oa/+hp3+bpD+co/+ZI/+Xoz9Vos1azWoAAAAeHRSTlMAvwe8iBv3u3BtPR61ZUcx9/Xy7ebf3dHPt7Gtqqebm5aMh4V3cXBcW1pGMSUaEgX729qtqqmll3VlRT84Ny8g/vr48fDw7u7t5tzVz8vIx8bGxsW/u7KwsLCmnZybko6Ghn1wb2hkX0Q+KhMT+eTjx8bDwa1NSEgfarKCAAAHAElEQVR42uzTv2qDQBwH8F/cjEtEQUEQBOkUrIMxRX2AZMiWPVsCCYX+rxacmkfIQzjeIwRK28GXKvQ0talytvg7MvRz2/c47ntwP/i7tehpkzyfaJ64Bu4EUcsrNFEArpbq2xF1CfxIN681biXgJFSyWkoEXARy1kAOgINIzhrJEaBz1Jcvur9Y+HolUB3AZuxLii3RSLKVQ+gBsvt9yaw/1jEP8QPg0t8LInwjlrkOqB5JwYYjNikEgMkglNG......
                                                        <div class="mt-5 text-center">
                                                            <h5 class="mb-1 text-lg font-bold">Hapus Ekstrakulikuler?</h5>
                                                            <p class="text-slate-500 dark:text-zink-200 text-sm">Apakah Anda yakin ingin menghapus data ekstrakurikuler <strong>{{ $ex->name }}</strong> ini?</p>
                                                            <div class="flex justify-center gap-2 mt-6">
                                                                <form action="{{ route('admin.extrakulikuler.destroy', $ex->id) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="reset" data-modal-close="deleteModal{{ $ex->id }}"
                                                                        class="bg-slate-100 text-slate-500 btn hover:bg-slate-200 px-4 py-2 rounded text-sm font-medium mr-2">Batal</button>
                                                                    <button type="submit"
                                                                        class="text-white bg-red-500 border-red-500 btn hover:bg-red-600 px-4 py-2 rounded text-sm font-medium">Ya, Hapus!</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        @else
                            <div class="py-12 text-center text-slate-500 dark:text-zink-200">
                                <i data-lucide="trophy" class="mx-auto size-12 text-slate-300 dark:text-zink-500 mb-3"></i>
                                <p class="font-medium">Belum ada data ekstrakurikuler yang terdaftar.</p>
                                <a href="{{ route('admin.extrakulikuler.create') }}" class="text-custom-500 hover:underline mt-2 inline-block text-sm font-semibold">
                                    Tambah Ekstrakurikuler Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
