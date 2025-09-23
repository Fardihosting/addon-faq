@php
  $faqs = \App\Addons\Faq\Models\Faq::where('group_id', $group->id)
            ->orderBy('sort_order', 'asc')
            ->get();
@endphp

@if($faqs->isNotEmpty())
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">
      {{ __('faq::messages.client.title') }}
    </h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">
      {{ __('faq::messages.client.description') }}
    </p>
  </div>
  <div class="max-w-5xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      @foreach ($faqs as $faq)
          <div class="py-8">
      <div class="flex gap-x-5">
        <svg class="shrink-0 mt-1 size-6 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>

        <div class="grow">
          <h3 class="md:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            {{ $faq->trans('title') }}
          </h3>
          <p class="mt-1 text-gray-500 dark:text-neutral-500">
            {!! nl2br($faq->trans('answer')) !!}
          </p>
        </div>
      </div>
    </div>
      @endforeach
    </div>
  </div>
</div>
@endif
