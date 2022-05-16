<?php

namespace App\Http\Livewire\Data;

use App\Models\Table;
use Livewire\Component;

class Meja extends Component
{
    public $cari;
    public $edit;

    public $nama_meja;
    public $kategori;
    public $kode;

    public function openModal(){
        $this->reset();
        $this->emit('openModalData');
    }

    public function openModalDelete(){
        $this->emit('openModalDeleteConfirm');
    }

    public function removeIP(){
        try{
            if($this->edit){
                $this->edit->ip = null;
                $this->edit->save();
            }
        } catch (\Exception $e) { dd($e); }
    }

    public function openModalEdit($id){
        $data = Table::find($id);

        $this->nama_meja = $data->table_name;
        $this->kode = $data->code;
        $this->edit = $data;

        $this->emit('openModalData');
    }

    public function saveDelete(){
        optional($this->edit)->delete();

        $this->reset();
        $this->emit('closeModalDeleteConfirm');
    }

    public function saveEdit(){
        $this->validate([
            'nama_meja' => ['required'],
            'kode' => ['required','unique:tables,code,' . optional($this->edit)->id]
        ]);

        try{
            $table = Table::find($this->edit->id);
            $table->table_name = $this->nama_meja;
            $table->code = $this->kode;
            $table->save();
        } catch (\Exception $error){ dd($error); }

        $this->emit('closeModalData');
        $this->reset();
    }

    public function save(){
        if($this->edit) return $this->saveEdit();

        $this->validate([
            'nama_meja' => ['required'],
            'kode' => ['required','unique:tables,code'],
            'kategori' => ['required'],
        ]);

        try{
            $table = new Table();
            $table->table_name = $this->nama_meja;
            $table->code = $this->kode;
            $table->category = $this->kategori;

            $table->save();
        } catch (\Exception $error){ dd($error); }

        $this->emit('closeModalData');
        $this->reset();
    }

    public function getRowsProperty(){
        return Table::query()
            ->when($this->cari, function($query, $value){
                $query->where('table_name', 'LIKE', '%' . $value . '%');
            })
            ->get();
    }

    public function render()
    {
        return view('data.meja',[
            'rows' => $this->rows
        ]);
    }
}
