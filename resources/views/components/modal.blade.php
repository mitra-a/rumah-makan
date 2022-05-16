<div class="modal fade" id="{{ $key }}" wire:ignore.self wire:key="key-{{ $key }}">
    <button
        id="button-open-{{ $key }}"
        data-bs-toggle="modal"
        data-bs-target="#{{ $key }}"
        class="d-none"
        type="button"
    ></button>

    <div class="modal-dialog modal-{{ isset($size) ? $size : 'lg' }} modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                
                <button 
                    type="button" 
                    class="btn-close button-class"
                    data-bs-dismiss="modal" 
                    aria-label="Close">
                </button>
            </div>

            {{ $slot }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            buttonClose = document.querySelectorAll('.button-class');
            buttonOpen{{ $key }} = document.getElementById('button-open-{{ $key }}');
            Livewire.on('close{{ $key }}', () => {
                Array.from(buttonClose).map((item) => item.click())
            })
            Livewire.on('open{{ $key }}', () => {
                buttonOpen{{ $key }}.click()
            })
        })
    </script>
</div>