<div>
    <div class="row g-2 align-items-center">
        <div class="col">
            <div class="page-pretitle">Selamat Datang</div>
            <div class="page-title">Data Meja</div>
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
        <div class="col-12 col-lg-6" 
            type="button"
            wire:key="{{ $row->id }}"
            wire:click="openModalEdit('{{ $row->id }}')"
        >
                <div class="card card-borderless mb-3">
                    <div class="card-body">
                        <h3 class="card-title d-flex align-item-center ">
                            {{ $row->table_name }}
                            <span class="badge bg-{{ $row->category == 'meja' ? 'blue' : 'orange' }}-lt ms-auto">{{ ucfirst($row->category) }}</span>
                        </h3>
                        <div>
                            <table>
                                <tr>
                                    <td>Kode</td>
                                    <td class="px-2">:</td>
                                    <td><b>{{ $row->code }}</b></td>
                                </tr>
                                <tr>
                                    <td>IP login</td>
                                    <td class="px-2">:</td>
                                    <td>{{ $row->ip ?? 'kosong' }}</td>
                                </tr>
                            </table>
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

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <x-input 
                            name="nama_meja"
                            title="Nama Meja"
                            type="text"
                            placeholder="masukan nama meja"
                            wire:model.defer="nama_meja"
                        />
                    </div>

                    <div class="col-lg-6 col-12">  
                        <x-input 
                            name="kode"
                            title="Kode"
                            type="text"
                            placeholder="masukan kode berupa 5 kode unik"
                            wire:model.defer="kode"
                        />
                    </div>
                </div>
                
                @if(!$edit)
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input 
                                    type="radio" 
                                    name="category" 
                                    value="meja" 
                                    class="form-selectgroup-input" 
                                    wire:model.defer="kategori" >

                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Meja</span>
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input 
                                    type="radio" 
                                    name="category" 
                                    value="dapur" 
                                    class="form-selectgroup-input" 
                                    wire:model.defer="kategori" >

                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Dapur</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                @endif

                @if(optional($edit)->ip)
                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="me-auto">
                                <span>IP Auto Login : </span> <br />
                                <b>{{ $edit->ip }}</b>
                            </div>

                            <button 
                                type="button"
                                wire:click="removeIP()"
                                class="btn">
                                x
                            </button>
                        </div>
                    </div>
                @endif
            </div>

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