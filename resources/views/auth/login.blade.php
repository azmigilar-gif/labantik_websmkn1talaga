@extends('admin.layouts.master')
@section('title', 'Login - Web Pengelolaan Website Sekolah')
@section('content')
    <div class="card dark:bg-zink-500/70 mb-0 border-none bg-white/70 shadow-none xl:w-2/3">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="card-body !px-12 !py-12">

                    <div class="text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome Back !</h4>
                        <p class="dark:text-zink-200 text-slate-500">Sign in to continue to Web Admin Pengelola Website
                            Sekolah.</p>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="mt-5 text-sm text-red-500">{{ $error }}</div>
                        @endforeach
                    @endif

                    <form action="{{ route('authenticate') }}" class="mt-7" method="POST">
                        @csrf
                        <div class="mb-3 hidden rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-500 dark:border-green-500/50 dark:bg-green-400/20"
                            id="successAlert">
                            You have <b>successfully</b> signed in.
                        </div>
                        <div class="mb-3">
                            <label for="username" class="mb-2 inline-block text-base font-medium">Email</label>
                            <input type="text" id="username" name="email"
                                class="form-input dark:bg-zink-600/50 dark:border-zink-500 focus:border-custom-500 dark:disabled:bg-zink-600 dark:disabled:border-zink-500 dark:disabled:text-zink-200 dark:text-zink-100 dark:focus:border-custom-800 dark:placeholder:text-zink-200 border-slate-200 placeholder:text-slate-400 focus:outline-none disabled:border-slate-300 disabled:bg-slate-100 disabled:text-slate-500"
                                placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="mb-2 inline-block text-base font-medium">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-input dark:bg-zink-600/50 dark:border-zink-500 focus:border-custom-500 dark:disabled:bg-zink-600 dark:disabled:border-zink-500 dark:disabled:text-zink-200 dark:text-zink-100 dark:focus:border-custom-800 dark:placeholder:text-zink-200 border-slate-200 placeholder:text-slate-400 focus:outline-none disabled:border-slate-300 disabled:bg-slate-100 disabled:text-slate-500"
                                placeholder="Enter password">
                        </div>
                        <div class="mt-10">
                            <input type="submit" value="Sign in" class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 w-full text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">

                        </div>
                    </form>
                </div>
            </div>
            <div
                class="card dark:bg-zink-500/60 mx-2 mb-2 mt-2 hidden border-none bg-white/60 shadow-none lg:col-span-7 lg:block">
                <div class="card-body flex h-full flex-col !px-10 !pb-0 !pt-10">
                    <div class="flex items-center justify-between gap-3">
                        <div class="grow">
                            <a href="#">
                                <img src="{{ asset('assets/images/logosmk.png') }}" alt=""
                                    class="hidden h-14 dark:block">
                                <img src="{{ asset('assets/images/logosmk.png') }}" alt=""
                                    class="block h-14 dark:hidden">
                            </a>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <img src="{{ asset('assets/images/img-01.png') }}" alt="" class="mx-auto md:max-w-[24rem]">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
