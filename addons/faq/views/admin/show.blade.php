@extends('admin/layouts/admin')

@section('title', __('faq::messages.update.title'))

@section('content')
<div class="container mx-auto">
  <form method="POST" action="{{ route($routePath.'.update', $faq->id) }}">
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-heading flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('faq::messages.update.title') }}
          </h2>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('faq::messages.update.description') }}
          </p>
        </div>
        <div class="mt-3 sm:mt-0">
          <button class="btn btn-primary">
            {{ __('faq::messages.bouton.update') }}
          </button>
        </div>
      </div>

      <div class="card-body space-y-5">
        @include('admin/shared/input', [
          'name'          => 'title',
          'label'         => __('faq::messages.formulaire.title'),
          'value'         => old('title', $faq->title),
          'translatable'  => true,
        ])
        @include('admin/shared/select', [
          'name'          => 'group_id',
          'label'         => __('faq::messages.formulaire.group'),
          'options'       => $groups,
          'value'         => old('group_id', $faq->group_id ?? ''),
        ])
        @include('admin/shared/textarea', [
          'name'          => 'answer',
          'label'         => __('faq::messages.formulaire.answer'),
          'value'         => old('answer', isset($faq) ? $faq->trans('answer', $faq->answer ?? '') : ''),
          'rows'          => 12,
          'translatable'  => isset($faq),
        ])
        @include('admin/shared/input', [
          'type'          => 'number',
          'name'          => 'sort_order',
          'label'         => __('global.sort_order'),
          'value'         => old('sort_order', $faq->sort_order ?? 0),
          ])
        </div>
      </div>
    </form>
  </div>
  @include('admin/translations/overlay', ['item' => $faq, 'id' => $faq->id])
@endsection
