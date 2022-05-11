<?php

namespace App\Controllers;

use App\Models\TabelData;
use CodeIgniter\Validation\Rules;
use DateTime;
use SebastianBergmann\Diff\Diff;

class Kapal extends BaseController
{

    protected $TabelData;
    public function __construct()
    {
        helper('form');
        // $this->load->model('tabeldata');
    }

    // Tujuan Kapal
    public function tujuanKapal()
    {
        $model = new TabelData();
        $ambilKode = $model->kodeTujuanKapal();
        $nourut = substr($ambilKode, 3, 4);
        $newKode = $nourut + 1;
        $data = [
            'kodeTujuanKapal' => $newKode,
            'tujuanKapal' => $model->getTujuanKapal()
        ];
        return view('bmo/tujuanKapal/index', $data);
    }

    public function tujuanKapalAdd()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $data = [
                'tk_kode' => $this->request->getPost('tk_kode'),
                'tk_tujuan' => $this->request->getPost('tk_tujuan'),
                'tk_jam' => $this->request->getPost('tk_jam')
            ];
            $this->db->table('tujuan_kapal')->insert($data);
            return redirect()->to(site_url('tujuanKapal'))->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function tujuanKapalEdit()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('tk_id');
            $default = strtotime("08:00:00"); #benar
            $jam = $this->request->getPost('tk_jam');
            // $res = $default - $jam;
            // $jam1 = date("H:i:s", strtotime($default));
            // $hasil = strtotime($jam) + strtotime($jam1);
            $data = [
                'tk_kode' => $this->request->getPost('tk_kode'),
                'tk_tujuan' => $this->request->getPost('tk_tujuan'),
                'tk_jam' => $this->request->getPost('tk_jam'),
            ];
            echo $default;
            echo "<br>";
            $jadijam = strtotime($jam);
            echo "<br>";
            $currentDateTime = date('Y-m-d H:i:s');
            echo $currentDateTime;
            echo "<br>";
            $res = $default + $jadijam;
            echo "<br>";
            date_default_timezone_set("Asia/Bangkok");
            echo date_default_timezone_get();
            echo "<br>";
            echo date("H:i:s", $res);
            // echo date("H:i:s", $res);
            // $dk = $this->db->table('tujuan_kapal')->getWhere(['tk_id' => $id])->getRow();

            // // $data = $this->db->table('tujuan_kapal')->where(['tk_id' => $id])->getRow();

            // $time = "00:00:10";
            // return date('H', $time);
            // return date('H', $dk->tk_jam);

            // echo date('d F Y', strtotime($dk->tk_jam));
            // echo strtotime($dk->tk_jam);
            echo "<br>";
            // echo date("H:i", $jam1);
            // echo date("H:i:", strtotime($hasil));
            // $this->db->table('tujuan_kapal')->where(['tk_id' => $id])->update($data);
            // return redirect()->to(site_url('tujuanKapal'))->with('success', 'Data Berhasil Dirubah!');
        }
    }

    public function tujuanKapalDel()
    {
        if (session()->get('user_level') <> "admin") {
            return redirect()->to(site_url('home'));
        } else {
            $id = $this->request->getPost('tk_id');
            $this->db->table('tujuan_kapal')->where(['tk_id' => $id])->delete();
            return redirect()->to(site_url('tujuanKapal'))->with('success', 'Data Berhasil Dihapus!');
        }
    }

    // Detail Kapal
    public function detailKapal()
    {
        $model  = new TabelData();
        $data = [
            'kodeKapal' => $model->getKodeKapal(),
            'tujuanKapal' => $model->getTujuanKapal(),
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
                    'dk_tujuan' => $this->request->getPost('dk_tujuan'),
                    'dk_day' => $this->request->getPost('dk_day'),
                    'dk_end' => $this->request->getPost('dk_end'),
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
                    'dk_tujuan' => $this->request->getPost('dk_tujuan'),
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
                        'dk_tujuan' => $this->request->getPost('dk_tujuan'),
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
            'detailKapal' => $model->getDetailKapal()
        ];
        return view('bmo/bookingKapal/index', $data);
    }

    public function bookingKapalAdd()
    {
        $kode_kapal = $this->request->getPost('transaksi_kode_kapal');
        $dk = $this->db->table('detail_kapal')->getWhere(['dk_id' => $kode_kapal])->getRow();
        $date = date('l', strtotime($this->request->getPost('transaksi_tgl_booking')));
        if ($date == "Saturday" or $date == "Sunday") {
            $harga_booking = $dk->dk_end;
        } else {
            $harga_booking = $dk->dk_day;
        }
        $tujuan = $this->db->table('tujuan_kapal')->getWhere(['tk_kode' => $dk->dk_tujuan])->getRow();
        $transaksi = $this->db->table('transaksi_kapal')->getWhere(['transaksi_kode_kapal' => $kode_kapal, 'transaksi_tgl_booking' => $this->request->getPost('transaksi_tgl_booking')])->getRow();
        if ($transaksi != null) {
            // return redirect()->back()->with('error', 'Maaf tanggal tersebut sudah terbooking, Silahkan cari tanggal yang lain!');
            $time1 = strtotime($this->request->getPost('transaksi_tgl_booking') . " " . $transaksi->transaksi_jam_kembali);
            $time2 = strtotime($this->request->getPost('transaksi_tgl_booking') . " " . $tujuan->tk_jam);
            $diff = $time1 + $time2;
            $jam = floor($diff / (60 * 60));
            echo $this->request->getPost('transaksi_tgl_booking') . " " . $transaksi->transaksi_jam_kembali;
        } else {
            $data = [
                'transaksi_nama' => $this->request->getPost('transaksi_nama'),
                'transaksi_email' => $this->request->getPost('transaksi_email'),
                'transaksi_telp' => $this->request->getPost('transaksi_telp'),
                'transaksi_tgl_booking' => $this->request->getPost('transaksi_tgl_booking'),
                'transaksi_tgl_selesai' => "0000-00-00",
                'transaksi_jam_booking' => "08:00:00",
                'transaksi_jam_kembali' => "08:15:00",
                'transaksi_kode_kapal' => $dk->dk_id,
                'transaksi_harga' => $harga_booking,
                'transaksi_tujuan' => $dk->dk_tujuan,
                'transaksi_status_kapal' => "Booking",
                'transaksi_status_pembayaran' => "Belum",
                'transaksi_bayar' => "0",
                'transaksi_nomor_bank' => "0",
            ];
            // $this->db->table('transaksi_kapal')->insert($data);
            // return redirect()->to(site_url('bookingKapal'))->with('success', 'Data Berhasil Disimpan!');
            echo "Simpan!";
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
