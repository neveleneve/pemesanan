<div class="row">
    <div class="col-12">
        <ol class="breadcrumb fs-4">
            @for ($i = 0; $i < count($list); $i++)
                @if ($i + 1 == count($list))
                    <li class="breadcrumb-item fw-bold active">{{ $list[$i] }}</li>
                @else
                    <li class="breadcrumb-item">{{ $list[$i] }}</li>
                @endif
            @endfor
        </ol>
    </div>
</div>
