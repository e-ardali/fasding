@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @if (! did_action("elementor/loaded") || ! \Elementor\Plugin::instance()->documents->get(get_the_ID())?->is_built_with_elementor())
      @include('partials.page-header')
    @endif
    @includeFirst(['partials.content-page', 'partials.content'])
  @endwhile
@endsection
