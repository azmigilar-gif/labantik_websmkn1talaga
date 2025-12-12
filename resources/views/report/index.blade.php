@extends('layouts.app')

@section('title', 'Stacked Columns Chart')

@section('content')
<div class="container mx-auto px-4 py-32">
    <div class="mx-auto max-w-3xl">
        <div class="card">
            <div class="card-body">
                <h6 class="text-15 mb-4">Stacked Columns</h6>
                <div id="stackedColumnChart"
                     class="apex-charts"
                     style="min-height: 365px;"
                     data-chart-colors='["bg-custom-500", "bg-orange-500", "bg-green-500", "bg-yellow-500"]'
                     dir="ltr">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush
