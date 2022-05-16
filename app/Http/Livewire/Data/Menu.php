<?php

namespace App\Http\Livewire\Data;

use App\Models\Menu as ModelsMenu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Menu extends Component
{
    use WithFileUploads;

    public $cari;

    public $nama_menu;
    public $harga;
    public $foto;
    public $kategori;
    public $edit;

    public function openModal(){
        $this->reset();
        $this->emit('openModalData');
    }

    public function openModalDelete(){
        $this->emit('openModalDeleteConfirm');
    }

    public function openModalEdit($id){
        $data = ModelsMenu::find($id);

        $this->nama_menu = $data->menu_name;
        $this->harga = $data->price;
        $this->foto = null;
        $this->kategori = $data->category;
        $this->edit = $data;

        $this->emit('openModalData');
    }

    public function saveDelete(){
        Storage::disk('foto')->delete(optional($this->edit)->picture);
        optional($this->edit)->delete();

        $this->reset();
        $this->emit('closeModalDeleteConfirm');
    }

    public function saveEdit(){
        $this->validate([
            'nama_menu' => ['required'],
            'harga' => ['required'],
            'foto' => ['nullable','image','max:2024'],
        ]);

        try{
            $menu = ModelsMenu::find($this->edit->id);
            $menu->menu_name = $this->nama_menu;
            $menu->price = $this->harga;
            $menu->category = $this->kategori;

            if($this->foto){
                Storage::disk('foto')->delete($this->edit->picture);
                $menu->picture = $this->foto->store('/','foto');
            }
            $menu->save();
        } catch (\Exception $error){ dd($error); }

        $this->emit('closeModalData');
        $this->reset();
    }

    public function save(){
        if($this->edit) return $this->saveEdit();

        $this->validate([
            'nama_menu' => ['required'],
            'harga' => ['required'],
            'foto' => ['required','image','max:2024'],
        ]);

        try{
            $menu = new ModelsMenu();
            $menu->menu_name = $this->nama_menu;
            $menu->price = $this->harga;
            $menu->category = $this->kategori;
            $menu->picture = $this->foto->store('/','foto');
            $menu->save();
        } catch (\Exception $error){ dd($error); }

        $this->emit('closeModalData');
        $this->reset();
    }

    public function getRowsProperty(){
        return ModelsMenu::query()
            ->when($this->cari, function($query, $value){
                $query->where('menu_name', 'LIKE', '%' . $value . '%');
            })
            ->get();
    }

    public function render()
    {
        return view('data.menu',[
            'rows' => $this->rows
        ]);
    }
}
