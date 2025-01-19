<div class="dropdown d-inline-block">
    <button class="btn btn-soft-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="true">
        <i class="ri-more-fill align-middle"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end"
        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 29.4643px, 0px);">
        @foreach ($actions as $key => $item)
            <li>
                <a class="dropdown-item edit-item-btn action" href="{{ $item }}"><i
                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                    {{ $key }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
