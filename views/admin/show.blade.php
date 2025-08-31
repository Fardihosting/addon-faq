@extends('admin/layouts/admin')

@section('title', __('faq::messages.update.title'))

@section('content')
<div class="container mx-auto">
  <form method="POST" 
        action="{{ isset($faq) ? route($routePath.'.update', $faq->id) : route($routePath.'.store') }}">
    @csrf
    @if(isset($faq))
      @method('PUT')
    @endif

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
        <div>
          <label class="label">{{ __('faq::messages.formulaire.title') }}</label>
          <input type="text" name="title"
                 value="{{ old('title', $faq->title ?? '') }}"
                 class="input-text w-full">
          @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="group_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              {{ __('faq::messages.formulaire.group') }}
          </label>
          <select id="group_id" name="group_id"
                  class="block w-full rounded-md border border-gray-300 dark:border-gray-700
                         bg-gray-50 dark:bg-gray-700
                         text-gray-900 dark:text-gray-200
                         focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              @foreach ($groups as $id => $name)
                  <option value="{{ $id }}"
                      @selected(old('group_id', $faq->group_id ?? '') == $id)>
                      {{ $name }}
                  </option>
              @endforeach
          </select>
          @error('group_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="label">{{ __('faq::messages.formulaire.reponse') }}</label>
          <textarea name="reponse" rows="12"
                    class="input-text w-full">{{ old('reponse', $faq->reponse ?? '') }}</textarea>
          @error('reponse')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        @if ($errors->any())
          <div class="rounded-md border border-red-300 dark:border-red-700 bg-red-50 dark:bg-red-900/20 p-3">
            <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-300">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  </form>
</div>
@endsection
