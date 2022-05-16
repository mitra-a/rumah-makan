<div>
    <div class="row g-2 align-items-center">
        <div class="col">
            <div class="page-pretitle">Selamat Datang</div>
            <div class="page-title">Data Menu</div>
        </div>

        <div class="col-12 col-md-auto ms-auto d-print-none">
            <div class="btn-list">
                <div 
                    wire:click="openModal"
                    class="btn btn-primary d-none d-sm-inline-block">
                    <i class="bx bx-plus me-2 icon"></i>
                    <span>Tambah Data</span>
                </div> 
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-3">
        <div class="col-lg-4">
            <input 
                type="text" 
                placeholder="Cari Data"
                wire:model.debounce="cari" 
                class="form-control">
        </div>
    </div>

    <div class="row">
        @forelse ($rows as $row)    
            <div 
                class="col-12" 
                wire:key="{{ $row->id }}" >
                <div 
                    class="card w-100 mb-2"
                    wire:click="openModalEdit('{{ $row->id }}')"
                    type="button"
                >
                    <div class="card-body">
                        <div class="d-flex">
                            <img class="avatar" src="{{ $row->getImage() }}" />
                            <div class="ms-2">
                                <h4 class="mb-0">
                                    <span class="badge bg-{{ $row->category == 'makanan' ? 'blue' : 'orange' }}-lt me-1">{{ $row->category }}</span>
                                    {{ $row->menu_name }}
                                </h4>
                                <span>{{ money_format_idr($row->price) }}</span> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <x-empty />
        @endforelse
    </div>

    {{-- MODAL EDIT DAN CREATE --}}
    <form wire:submit.prevent="save">
        <x-modal key="ModalData" title="{{ $edit ? 'Edit' : 'New' }} Menu">

            @if($edit)
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <img 
                                src="{{ $edit->getImage() }}"
                                class="rounded"
                            />
                        </div>

                        <div class="col-lg-8 col-12">
                            <x-input 
                                name="nama_menu"
                                title="Nama Menu"
                                type="text"
                                placeholder="masukan nama menu"
                                wire:model.defer="nama_menu"
                            />

                            <div class="form-selectgroup-boxes row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input 
                                            type="radio" 
                                            name="category" 
                                            value="makanan" 
                                            class="form-selectgroup-input" 
                                            wire:model.defer="kategori" >
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Makanan</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input 
                                            type="radio" 
                                            name="category" 
                                            value="minuman" 
                                            class="form-selectgroup-input" 
                                            wire:model.defer="kategori" >

                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Minuman</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            
                            <x-input 
                                name="harga"
                                title="Harga"
                                type="number"
                                placeholder="masukan harga menu"
                                wire:model.defer="harga"
                            />
                            
                            <x-input 
                                name="foto"
                                title="Foto"
                                type="file"
                                placeholder="masukan nama menu"
                                wire:model.defer="foto"
                            />
                        </div>
                    </div>
                </div>  
            @else
                <div class="modal-body">
                    <x-input 
                        name="nama_menu"
                        title="Nama Menu"
                        type="text"
                        placeholder="masukan nama menu"
                        wire:model.defer="nama_menu"
                    />

                    
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input 
                                    type="radio" 
                                    name="category" 
                                    value="makanan" 
                                    class="form-selectgroup-input" 
                                    wire:model.defer="kategori" >
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Makanan</span>
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input 
                                    type="radio" 
                                    name="category" 
                                    value="minuman" 
                                    class="form-selectgroup-input" 
                                    wire:model.defer="kategori" >

                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Minuman</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <x-input 
                                name="harga"
                                title="Harga"
                                type="number"
                                placeholder="masukan harga menu"
                                wire:model.defer="harga"
                            />
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-input 
                                name="foto"
                                title="Foto"
                                type="file"
                                placeholder="masukan nama menu"
                                wire:model.defer="foto"
                            />
                        </div>
                    </div>
                </div>
            @endif

            <div class="modal-footer">
                <div>
                    <a 
                        href="#" 
                        class="btn btn-link link-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </a>

                    @if($edit)
                        <button
                            type="button" 
                            wire:click="openModalDelete"
                            class="btn btn-danger ms-auto">
                            Hapus ?
                        </button>
                    @endif
                </div>

                <button
                    type="submit" 
                    class="btn btn-primary ms-auto" >
                    Simpan
                </button>
            </div>
        </x-modal>
    </form>

    {{-- MODAL DELETE --}}
    <form wire:submit.prevent="saveDelete">
        <x-modal size="sm" key="ModalDeleteConfirm" title="Delete Menu">
            <div class="modal-status bg-danger"></div>
            
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/alert-triangle</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>
                <h3>Apakah anda yakin?</h3>
                <div class="text-muted">Apakah Anda benar-benar ingin menghapus data ini? Apa yang telah Anda lakukan tidak dapat dibatalkan.</div>
            </div>

            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a 
                                href="#" 
                                class="btn w-100" 
                                data-bs-dismiss="modal">
                                Batal
                            </a>
                        </div>
                        <div class="col">
                            <button
                                type="submit"
                                class="btn btn-danger w-100" 
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </x-modal>
    </form>
</div>
