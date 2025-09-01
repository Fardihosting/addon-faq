@extends('admin/layouts/admin')

@section('title', __('faq::messages.create.title'))

@section('content')
<div class="container mx-auto">
  <form method="POST" action="{{ route($routePath.'.store') }}">
    @csrf

    <div class="card">
      <div class="card-heading flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('faq::messages.create.title') }}
          </h2>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('faq::messages.create.description') }}
          </p>
        </div>

        <div class="mt-3 sm:mt-0">
          <button class="btn btn-primary">
            {{ __('admin.create') }}
          </button>
        </div>
      </div>

      <div class="card-body space-y-5">
        <div>
          <label class="label">{{ __('faq::messages.formulaire.title') }}</label>
          <input type="text" name="title" value="{{ old('title') }}" class="input-text w-full">
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
                    placeholder-gray-400
                    focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach ($groups as $id => $name)
                    <option value="{{ $id }}" @selected(old('group_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @error('group_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
          <label class="label">{{ __('faq::messages.formulaire.reponse') }}</label>
          <textarea name="reponse" rows="12" class="input-text w-full">{{ old('reponse') }}</textarea>
          @error('reponse')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
