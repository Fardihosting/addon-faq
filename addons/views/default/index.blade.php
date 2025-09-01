@extends('layouts.front')
@section('title', 'FAQ — '.$group->name)
@section('content')

<!-- FAQ -->
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

  <div class="max-w-2xl mx-auto">
    @if($faqs->isEmpty())
    @else
      <div class="space-y-4">
        @foreach ($faqs as $faq)
          @php
            $i = $loop->index;
            $title   = method_exists($faq, 'trans') ? $faq->trans('title', $faq->title)     : $faq->title;
            $content = method_exists($faq, 'trans') ? $faq->trans('reponse', $faq->reponse) : $faq->reponse;
          @endphp
          
          <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow duration-300"
               id="faq-item-{{ $i }}">
            <button
              class="w-full p-6 text-center focus:outline-none rounded-xl"
              onclick="toggleFAQ({{ $i }})"
              aria-expanded="false"
              aria-controls="faq-content-{{ $i }}"
            >
              <div class="flex items-center">
                <div class="w-5 h-5"></div>
                <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white text-center flex-1">
                  {{ $title }}
                </h3>
                <div class="flex-shrink-0">
                  <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transform transition-transform duration-300" 
                       id="chevron-{{ $i }}" 
                       fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
                </div>
              </div>
            </button>
            
            <div id="faq-content-{{ $i }}" 
                 class="faq-content overflow-hidden transition-all duration-300 ease-in-out"
                 aria-labelledby="faq-button-{{ $i }}">
              <div class="px-6 pb-6">
                <div class="text-center">
                  <p class="text-gray-700 dark:text-neutral-300 leading-relaxed">
                    {{ $content }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endif

<script>
function toggleFAQ(index) {
  const content = document.getElementById(`faq-content-${index}`);
  const chevron = document.getElementById(`chevron-${index}`);
  const button = content.previousElementSibling;
  
  document.querySelectorAll('.faq-content').forEach((item, i) => {
    if (i !== index && item.classList.contains('active')) {
      item.classList.remove('active');
      item.style.maxHeight = '0px';
      
      const otherChevron = document.getElementById(`chevron-${i}`);
      const otherButton = item.previousElementSibling;
      
      if (otherChevron) {
        otherChevron.style.transform = 'rotate(0deg)';
      }
      if (otherButton) {
        otherButton.setAttribute('aria-expanded', 'false');
      }
    }
  });
  
  const isActive = content.classList.contains('active');
  
  if (isActive) {
    content.classList.remove('active');
    content.style.maxHeight = '0px';
    chevron.style.transform = 'rotate(0deg)';
    button.setAttribute('aria-expanded', 'false');
  } else {
    content.classList.add('active');
    content.style.maxHeight = content.scrollHeight + 'px';
    chevron.style.transform = 'rotate(180deg)';
    button.setAttribute('aria-expanded', 'true');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.faq-content').forEach((content, index) => {
    content.style.maxHeight = '0px';
    const chevron = document.getElementById(`chevron-${index}`);
    if (chevron) {
      chevron.style.transform = 'rotate(0deg)';
    }
  });
  
  window.addEventListener('resize', function() {
    document.querySelectorAll('.faq-content.active').forEach((content) => {
      content.style.maxHeight = content.scrollHeight + 'px';
    });
  });
});
</script>

@endsection