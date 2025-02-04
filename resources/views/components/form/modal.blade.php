@props(['size' => 'md', 'title', 'action' => null])

<div class="modal-dialog modal-lg modal-fullscreen-{{ $size }}-down modal-dialog-centered" role="dialog">
    <div class="modal-content">
        <form action="{{ $action }}" method="post" id="form_action">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFullscreenLgLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>

            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none"
                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                @if ($action)
                    <button type="submit" class="btn btn-primary ">Save</button>
                @endif
            </div>
        </form>
    </div>
</div>
