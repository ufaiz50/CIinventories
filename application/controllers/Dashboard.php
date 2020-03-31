<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['barang'] = $this->admin->count('barang');
        $data['barang_masuk'] = $this->admin->count('barang_masuk');
        $data['barang_keluar'] = $this->admin->count('barang_keluar');
        $data['supplier'] = $this->admin->count('supplier');
        $data['user'] = $this->admin->count('user');
        $data['stok'] = $this->admin->sum('barang', 'stok');
        $data['trend'] = $this->admin->groupby('barang_keluar', 'jumlah_keluar', 'barang_id');
        $data['dtbarang'] = $this->admin->databarang('barang');
        $data['barang_min'] = $this->admin->min('barang', 'stok', 10);
        $data['transaksi'] = [
            'barang_masuk' => $this->admin->getBarangMasuk(5),
            'barang_keluar' => $this->admin->getBarangKeluar(5)
        ];
        $data['modal'] = $this->admin->sum('barang_masuk', 'harga');
        $data['omset'] = $this->admin->sum('barang_keluar', 'harga');
        $data['barang_sisa'] = $this->admin->groupby('barang', 'stok', 'id_barang');

        // Line Chart
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $data['cbm'] = [];
        $data['cbk'] = [];

        foreach ($bln as $b) {
            $data['cbm'][] = $this->admin->chartBarangMasuk($b);
            $data['cbk'][] = $this->admin->chartBarangKeluar($b);
            $data['sbm'][] = $this->admin->sumBarangMasuk($b);
            $data['sbk'][] = $this->admin->sumBarangKeluar($b);
        }



        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
