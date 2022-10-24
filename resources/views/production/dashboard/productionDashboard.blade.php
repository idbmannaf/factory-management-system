@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <div class="card-title">
                      Production Dashboard
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection


@push('js')

    @auth

    @else

    @endauth

@endpush

