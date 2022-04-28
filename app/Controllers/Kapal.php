<?php

namespace App\Controllers;

use App\Models\TabelData;
use CodeIgniter\Validation\Rules;
use DateTime;

class Kapal extends BaseController
{

    protected $TabelData;
    public function __construct()
    {
        helper('form');
    }

    // Detail Kapal
    public function detailKapal()
    {
        $model  = new TabelData();
        $data = [
            'kodeKapal' => $model->getKodeKapal(),
            'detailKapal' => $model->getDetailKapal()
        ];
        return view('bmo/detailKapal/index', $data);
    }

    public function detailKapalAdd()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {

            $validated = $this->validate([
                'dk_gambar' => 'uploaded[dk_gambar]|mime_in[dk_gambar,image/jpg,image/gif,image/png,image/jpeg]|max_size[dk_gambar,5000]'
            ]);

            if ($validated == FALSE) {
                return redirect()->to(base_url('detailKapal'));
            } else {
                $file_gambar = $this->request->getFile('dk_gambar');
                $file_gambar->move(ROOTPATH . 'public/kapal/detail');

                $data = [
                    'dk_kode' => $this->request->getPost('dk_kode'),
                    'dk_nama' => $this->request->getPost('dk_nama'),
                    'dk_kapten' => $this->request->getPost('dk_kapten'),
                    'dk_kapasitas' => $this->request->getPost('dk_kapasitas'),
                    'dk_mesin' => $this->request->getPost('dk_mesin'),
                    'dk_day' => $this->request->getPost('dk_day'),
                    'dk_end' => $this->request->getPost('dk_end'),
                    'dk_perjam' => $this->request->getPost('dk_perjam'),
                    'dk_diskon' => $this->request->getPost('dk_diskon'),
                    'dk_gambar' => $file_gambar->getName(),
                ];

                $this->db->table('detail_kapal')->insert($data);
                return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Disimpan!');
            }
        }
    }

    public function detailKapalEdit()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            if ($this->request->getFile('dk_gambar')->getName() == "") {
                $id = $this->request->getPost('dk_id');
                $data = [
                    'dk_kode' => $this->request->getPost('dk_kode'),
                    'dk_nama' => $this->request->getPost('dk_nama'),
                    'dk_kapten' => $this->request->getPost('dk_kapten'),
                    'dk_kapasitas' => $this->request->getPost('dk_kapasitas'),
                    'dk_mesin' => $this->request->getPost('dk_mesin'),
                    'dk_day' => $this->request->getPost('dk_day'),
                    'dk_end' => $this->request->getPost('dk_end'),
                    'dk_perjam' => $this->request->getPost('dk_perjam'),
                    'dk_diskon' => $this->request->getPost('dk_diskon'),
                ];
                $this->db->table('detail_kapal')->where(['dk_id' => $id])->update($data);
                return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Dirubah!');
            } else {
                $id = $this->request->getPost('dk_id');
                $query = $this->db->table('detail_kapal')->getWhere(['dk_id' => $id]);
                $ambil = $query->getRow();
                $validated = $this->validate([
                    'dk_gambar' => 'uploaded[dk_gambar]|mime_in[dk_gambar,image/jpg,image/gif,image/png,image/jpeg]|max_size[dk_gambar,5000]'
                ]);

                if ($validated == FALSE) {
                    return redirect()->to(base_url('detailKapal'))->with('error', 'Maaf Format File Salah!');;
                    // echo "Data ada yang salah!";
                } else {
                    if ($ambil->dk_gambar != "") {
                        $target_gambar = '../public/kapal/detail/' . $ambil->dk_gambar;
                        unlink($target_gambar);
                    }
                    $file_gambar = $this->request->getFile('dk_gambar');
                    $file_gambar->move(ROOTPATH . 'public/kapal/detail');
                    $data = [
                        'dk_kode' => $this->request->getPost('dk_kode'),
                        'dk_nama' => $this->request->getPost('dk_nama'),
                        'dk_kapten' => $this->request->getPost('dk_kapten'),
                        'dk_kapasitas' => $this->request->getPost('dk_kapasitas'),
                        'dk_mesin' => $this->request->getPost('dk_mesin'),
                        'dk_day' => $this->request->getPost('dk_day'),
                        'dk_end' => $this->request->getPost('dk_end'),
                        'dk_perjam' => $this->request->getPost('dk_perjam'),
                        'dk_diskon' => $this->request->getPost('dk_diskon'),
                        'dk_gambar' => $file_gambar->getName(),
                    ];
                    $this->db->table('detail_kapal')->where(['dk_id' => $id])->update($data);
                    return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Dirubah!');
                }
            }
        }
    }

    public function detailKapalDel()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('dk_id');
            $query = $this->db->table('detail_kapal')->getWhere(['dk_id' => $id]);
            $ambil = $query->getRow();
            $target_gambar = '../public/kapal/detail/' . $ambil->dk_gambar;
            unlink($target_gambar);
            $this->db->table('detail_kapal')->where(['dk_id' => $id])->delete();
            return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Dihapus!');
        }
    }

    // BOOKING KAPAL
    public function bookingKapal()
    {
        $model  = new TabelData();
        $data = [
            'bookingKapal' => $model->getBookingKapal(),
            'customer' => $model->getCustomer(),
            'detailKapal' => $model->detailKapal()
        ];
        return view('bmo/bookingKapal/index', $data);
    }

    public function bookingKapalAdd()
    {
        $nama_kapal = $this->request->getPost('nama_kapal');
        $dk = $this->db->table('detail_kapal')->getWhere(['dk_id' => $nama_kapal])->getRow();
        $date = date('l', strtotime($this->request->getPost('tgl_booking')));
        if ($date == "Saturday" or $date == "Sunday") {
            $harga_booking = $dk->dk_end;
        } else {
            $harga_booking = $dk->dk_day;
        }
        $transaksi = $this->db->table('transaksi_kapal')->getWhere(['nama_kapal' => $nama_kapal, 'tgl_selesai' => $this->request->getPost('tgl_booking')])->getRow();
        if ($transaksi != null) {
            return redirect()->back()->with('error', 'Maaf tanggal tersebut sudah terbooking, Silahkan cari tanggal yang lain!');
        } else {
            $data = [
                'customer' => $this->request->getPost('customer'),
                'nama' => $this->request->getPost('nama'),
                'nama_kapal' => $this->request->getPost('nama_kapal'),
                'tgl_booking' => $this->request->getPost('tgl_booking'),
                'tgl_selesai' => "0000-00-00",
                'harga_booking' => $harga_booking,
                'harga_perjam' => $dk->dk_perjam,
                'harga_bayar' => "0",
                'kode_bank' => "0",
                'status_kapal' => "Booked",
                'status_pembayaran' => "Belum"
            ];
            $this->db->table('transaksi_kapal')->insert($data);
            return redirect()->to(site_url('bookingKapal'))->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function bookingKapalSailing()
    {
        if ($this->request->getPost('tgl_re') == "") {
            $id = $this->request->getPost('transaksi_id');
            $hasil = floatval($this->request->getPost('harga_booking')) - floatval($this->request->getPost('harga_bayar'));
            if ($this->request->getPost('harga_bayar') != null) {
                if ($hasil > 0) {
                    $status = "DP";
                    echo $status;
                } else {
                    $status = "Lunas";
                    echo $status;
                }
            } else {
                $status = "Belum";
                echo $status;
            }
            $data = [
                'customer' => $this->request->getPost('customer'),
                'nama' => $this->request->getPost('nama'),
                'harga_bayar' => $this->request->getPost('harga_bayar'),
                'kode_bank' => $this->request->getPost('kode_bank'),
                'status_kapal' => "Berlayar",
                'status_pembayaran' => $status
            ];
            $this->db->table('transaksi_kapal')->where(['transaksi_id' => $id])->update($data);
            return redirect()->to(site_url('bookingKapal'))->with('success', 'Data Berhasil Diverifikasi!');
        } else {
            $transaksi_id = $this->request->getPost('transaksi_id');
            $nama_kapal = $this->request->getPost('nama_kapal');
            $dk = $this->db->table('detail_kapal')->getWhere(['dk_id' => $nama_kapal])->getRow();
            $date = date('l', strtotime($this->request->getPost('tgl_re')));
            if ($date == "Saturday" or $date == "Sunday") {
                $harga_booking = $dk->dk_end;
            } else {
                $harga_booking = $dk->dk_day;
            }
            $transaksi = $this->db->table('transaksi_kapal')->getWhere(['nama_kapal' => $nama_kapal, 'tgl_booking' => $this->request->getPost('tgl_re')])->getRow();
            if ($transaksi != null) {
                return redirect()->back()->with('error', 'Maaf tanggal tersebut sudah terbooking, Silahkan cari tanggal yang lain!');
            } else {
                $data = [
                    'customer' => $this->request->getPost('customer'),
                    'nama' => $this->request->getPost('nama'),
                    'nama_kapal' => $this->request->getPost('nama_kapal'),
                    'tgl_booking' => $this->request->getPost('tgl_re'),
                    'tgl_selesai' => "0000-00-00",
                    'harga_booking' => $harga_booking,
                    'harga_perjam' => $dk->dk_perjam,
                    'harga_bayar' => "0",
                    'kode_bank' => "0",
                    'status_kapal' => "Booked",
                    'status_pembayaran' => "Belum"
                ];
                $this->db->table('transaksi_kapal')->insert($data);
                $this->db->table('transaksi_kapal')->where(['transaksi_id' => $transaksi_id])->delete();
                return redirect()->to(site_url('bookingKapal'))->with('success', 'Data Berhasil Dirubah!');
            }
        }
    }

    public function bookingKapalBack()
    {
        $id = $this->request->getPost('transaksi_id');
        $data = [
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'status_kapal' => "Kembali",
        ];
        $this->db->table('transaksi_kapal')->where(['transaksi_id' => $id])->update($data);
        return redirect()->to(site_url('bookingKapal'))->with('success', 'Data Berhasil Diverifikasi!');
    }

    public function bookingKapalDel()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            if (session()->get('user_level') <> "admin") {
                return redirect()->to(site_url('home'));
            } else {
                $id = $this->request->getPost('transaksi_id');
                $this->db->table('transaksi_kapal')->where(['transaksi_id' => $id])->delete();
                return redirect()->to(site_url('bookingKapal'))->with('success', 'Data Berhasil Dihapus!');
            }
        }
    }

    public function printBookingKapal()
    {
        $id = $this->request->getPost('transaksi_id');
        $data = [
            'transaksi' => $this->db->table('transaksi_kapal')
                ->join('customer', 'customer.cus_id=transaksi_kapal.customer')
                ->join('detail_kapal', 'detail_kapal.dk_id=transaksi_kapal.nama_kapal')
                ->where("transaksi_id='$id'")
                ->get()->getResultArray()
        ];
        return view('bmo/bookingKapal/print', $data);
    }

    public function laporanBookingKapal()
    {
        $model  = new TabelData();
        if ($this->request->getPost('tgl_awal') == "" && $this->request->getPost('tgl_sampai') == "") {
            $data = [
                'transaksi' => $model->transaksiKapal()
                    ->where("status_kapal='Kembali'")
                    ->get()->getResultArray(),
            ];
            return view('bmo/transaksiKapal/index', $data);
        } else {
            $tgl1 = $this->request->getPost('tgl_awal');
            $tgl2 = $this->request->getPost('tgl_sampai');
            $data = [
                'transaksi' => $model->transaksiKapal()
                    ->where("status_kapal='Kembali' AND tgl_booking BETWEEN '$tgl1' AND '$tgl2'")
                    ->get()->getResultArray(),
            ];
            $data['cetak'] = [
                ["tgl1" => $tgl1, "tgl2" => $tgl2]
            ];
            return view('bmo/transaksiKapal/index', $data);
        }
    }

    public function printTransaksiKapal()
    {
        $model  = new TabelData();
        $tgl1 = $this->request->getPost('tgl_awal');
        $tgl2 = $this->request->getPost('tgl_sampai');
        $data = [
            'transaksi' => $model->transaksiKapal()
                ->where("status_kapal='Kembali' AND tgl_booking BETWEEN '$tgl1' AND '$tgl2'")
                ->get()->getResultArray(),
        ];
        return view('bmo/transaksiKapal/print', $data);
    }
}
