@php
    $price = 0;
    $levels = $template->priceLevels ?? collect();

    if ($levels->count() === 1) {

        $price = $levels->first()->price;

    } elseif ($levels->count() >= 2) {

        if (empty($patientDetails) || empty($patientDetails->created_at)) {

            $price = optional($levels->sortByDesc('effective_from')->first())->price ?? 0;

        } else {

            $nextPrice = $levels
                ->sortByDesc('effective_from')
                ->first(function ($item) use ($patientDetails) {
                    return $item->effective_from->lte($patientDetails->created_at);
                });

            $price = $nextPrice ? $nextPrice->price : 0;
        }
    }
@endphp

<button type="button"
    class="{{ $btnClass ?? 'modern-btn' }}"
    style="width: {{ $width ?? '230px' }}; height: 30px; font-size: 0.8rem;"
    onclick="handleButtonClick('{{ $template->id }}')"
    data-price="{{ $price }}"
    data-name="{{ $template->name }}">
    {{ $template->name }}
</button>