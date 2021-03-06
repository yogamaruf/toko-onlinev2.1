<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('tokomodel');
		$this->load->library('template');
		if ($this->session->userdata('logged')<>1) {
				$this->session->set_flashdata("error","<div class='alert alert-danger alert-dismissable'>
                    	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    	<strong>Silahkan login terlebih dahulu !!!</strong></div>");

                redirect(base_url('admin/login'));
            }
	}

	public function index() { 
		$data = array(
				'produk'   => $this->db->get('produk')->num_rows(), //Menghitung jumlah baris TABEL PRODUK
				'merk'     => $this->db->get('merk')->num_rows(), //Menghitung jumlah baris TABEL MERK
				'kategori' => $this->db->get('kategori')->num_rows(), //Menghitung jumlah baris TABEL KATEGORI
				'customer' => $this->db->get('customer')->num_rows()); //Menghitung jumlah baris TABEL CUSTOMER
		$this->template->tampilan('admin/info/dashboard',$data);
	}

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ TAMPIL DATA ~  |

	public function tabelcustomer() { //Tabel Customer
		$data['data'] 	= $this->tokomodel->getcustomer();
		$this->template->tampilan('admin/tampil/tabelcustomer', $data);
	}

	public function detailprofil() { //Form Detail Tabel Customer
		$id = $this->uri->segment(4);
		$data = array(
				'detail' => $this->tokomodel->getdetailprofil($id)->row_array(),
				'data'   => $this->tokomodel->getedit($id)->row_array());
		$this->template->tampilan('admin/info/detailprofil', $data);
	}

	public function detailproduk() { //Form Detail Tabel Produk
		$id = $this->uri->segment(4);
		$data['data']   = $this->tokomodel->getproduk(array('idproduk' => $id))->row_array();
		$this->template->tampilan('admin/info/detailproduk', $data);
	}

	public function detailorder() { //Form Detail Tabel checkout
		$id = $this->uri->segment(4);
		$data = array(
				'nama' => $this->tokomodel->getdetailorder($id)->row_array(),
				'data' => $this->tokomodel->getdetailorder($id));
		$this->template->tampilan('admin/info/detailorder', $data);
	}

	public function tabelproduk() {	//Tabel Produk
		$data['data']  = $this->tokomodel->getproduk();
		$this->template->tampilan('admin/tampil/tabelproduk', $data);
	}

	public function user() { //Tabel User
		$data['data']  = $this->tokomodel->getuser();
		$this->template->tampilan('admin/tampil/user', $data);
	}

	public function halaman() { //Halaman
		$this->template->tampilan('admin/setting/halaman');
	}

	public function konten() { //Halaman
		$konten['konten'] = $this->tokomodel->getkonten();
		$this->template->tampilan('admin/setting/konten',$konten);
	}

	public function footer() { //Halaman
		$id = 15;
		$footer['footer'] = $this->tokomodel->getkonten($id)->row_array();
		$this->template->tampilan('admin/setting/footer',$footer);
	}

	/*public  function menu() {
		$data['hal'] = $this->tokomodel->gethal();
		$this->template->tampilan('admin/setting/menu',$data);
	}*/

	public function kategori() { //Tabel Kategori
		$data['data']  = $this->tokomodel->getkategori();
		$this->template->tampilan('admin/tampil/kategori', $data);
	}
 	
 	public function merk() { //Tabel Merk
		$data['data']  = $this->tokomodel->getmerk();
		$this->template->tampilan('admin/tampil/merk', $data);
	}

	public function order() { //Tabel Order
		$data['data']  = $this->tokomodel->getorder();
		$this->template->tampilan('admin/tampil/order', $data);
	}

	public function konfig() { //Form Konfigurasi WEB
		$data['set']  = $this->tokomodel->getkonfig()->row_array();
		$this->template->tampilan('admin/setting/konfigurasi',$data);
	}

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ END ~  |

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ MENAMPILKAN FORM TAMBAH ~  |

	public function formcustomer() { //CUSTOMER
		$id = $this->uri->segment(4);
		$data = array(
				'title'  => 'Tambah Customer',
				'title1' => 'Edit Customer',
				'data'  => !empty($id) ? $this->tokomodel->getedit($id)->row_array() : null,
				'data1' => !empty($id) ? $this->tokomodel->getdetailcustomer($id)->row_array() : null);
		$this->template->tampilan('admin/tambah/formcustomer',$data);
	}

	public function formuser($id=null) {
		$d = array(
				'title'  => 'Tambah User',
				'title1' => 'Edit User',
				'data'   => !empty($id) ? $this->tokomodel->getuser(array('idadmin' => $id))->row_array() : null);
		$this->template->tampilan('admin/tambah/formuser', $d);
	}

	public function formproduk($id=null) { //PRODUK
		$d = array(
				'title'  => 'Tambah Produk',
				'title1' => 'Edit Produk',
				'data'   => $this->tokomodel->getmerk(),
				'data1'  => $this->tokomodel->getkategori(),
				'data2'  => !empty($id) ? $this->tokomodel->getproduk(array('idproduk' => $id))->row_array() : null);
		$this->template->tampilan('admin/tambah/formproduk', $d);
	}

	public function formmerk($id=null) { //MERK
		$d = array(
				'title'  => 'Tambah Merk',
				'title1' => 'Edit Merk',
				'data'   => !empty($id) ? $this->tokomodel->getmerk(array('idmerk' => $id))->row_array() : null);
		$this->template->tampilan('admin/tambah/formmerk', $d);
	}

	/*public function formmenu() { //Halaman
		$id = $this->uri->segment(4);
		$data['menu'] = $this->tokomodel->gethal($id)->row_array();
		$this->template->tampilan('admin/setting/ubah/edithal',$data);
	}*/

	public function formkonten() { //Halaman
		$id = $this->uri->segment(4);
		$data['konten'] = $this->tokomodel->getkonten($id)->row_array();
		$this->template->tampilan('admin/setting/ubah/editkonten',$data);
	}

	public function formtambahkat() {
		$this->template->tampilan('admin/tambah/tambahkategori');
	}

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ END ~  |

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ TAMBAH dan SIMPAN DATA ~  |

	public function simpancustomer() { //Tambah data CUSTOMER
		$idcustom = $this->input->post('user');
		$simpan = array(
				'idcustom'  => $this->input->post('user'),
				'title'     => $this->input->post('title'),
				'firstname' => $this->input->post('namad'),
				'lastname'  => $this->input->post('namab'),
				'email'     => $this->input->post('email'),
				'password'  => $this->input->post('pass'),
				'date'      => $this->input->post('ttl'));

		if (isset($_POST['akun'])) {

			if (!empty($idcustom)) {
				$this->tokomodel->getubah($simpan,$idcustom);
			} else {
				$this->tokomodel->gettambah($simpan);
				$id = $this->db->insert_id();

				$detailsimpan = array(
							'idd'         => $this->input->post('detail'),
							'idcustom'    => $id);

				$this->tokomodel->gettambahdetail($detailsimpan);
			}

		} elseif (isset($_POST['detailakun'])) {

			if (!empty($idcustom)) {
				$this->tokomodel->getubah($simpan,$idcustom);

				$detailsimpan = array(
						'idd'         => $this->input->post('detail'),
						'idcustom'    => $idcustom, 
						'notelp'      => $this->input->post('notelp'),
						'norekening'  => $this->input->post('norekening'),
						'gender'      => $this->input->post('gender'),
						'alamat'      => $this->input->post('alamat'),
						'warganegara' => $this->input->post('warga'),
						'kodepos'     => $this->input->post('kodepos'),
						'kabupaten'   => $this->input->post('kabupaten'),
						'provinsi'    => $this->input->post('provinsi'));

				$this->tokomodel->getubahdetail($detailsimpan,$idcustom);
			} else {
				$this->tokomodel->gettambah($simpan);
				$id = $this->db->insert_id();

				$detailsimpan = array(
						'idd'         => $this->input->post('id'),
						'idcustom'    => $id, 
						'notelp'      => $this->input->post('notelp'),
						'norekening'  => $this->input->post('norekening'),
						'gender'      => $this->input->post('gender'),
						'alamat'      => $this->input->post('alamat'),
						'warganegara' => $this->input->post('warga'),
						'kodepos'     => $this->input->post('kodepos'),
						'kabupaten'   => $this->input->post('kabupaten'),
						'provinsi'    => $this->input->post('provinsi'));

				$this->tokomodel->gettambahdetail($detailsimpan);
			}

		}

		redirect(base_url('admin/toko/tabelcustomer'));
	}

	public function tambahkategori() { //Tambah data KATEGORI
		$simpan = array(
					'idkategori'   => $this->input->post('idkat'),
					'namakategori' => $this->input->post('nama'));

		$this->tokomodel->gettambahkat($simpan);
		redirect(base_url('admin/toko/kategori'));
	}

	public function simpanmerk() { //Tambah data dan Edit data MERK
		$config['upload_path']   = './assets/gambar/merk'; 
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
	    $config['max_size']      = '8000';
	    $config['max_width']     = '4024';

	    $this->upload->initialize($config);
	    $this->load->library('upload',$config);
	    $this->upload->do_upload('gambar');
	    $data = $this->upload->data();
				
		$id = $this->input->post('idmerk');
		$simpan = array(
					'idmerk'   => $this->input->post('idmerk'),
					'namamerk' => $this->input->post('nama'),
					'gambar'   => $data['file_name']);

		if(!empty($id)) {
			$img = $this->tokomodel->getmerk(array('idmerk' => $id))->row_array();
			unlink('assets/gambar/'.$img['gambar']);
			$this->tokomodel->getubahmerk($simpan,$id);
		} else {
			$this->tokomodel->gettambahmerk($simpan);
		}

		redirect(base_url('admin/toko/merk'));
	}

	public function simpanproduk() { //Tambah data dan Edit data pada PRODUK
		$config['upload_path']   = './assets/gambar/produk'; 
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
	    $config['max_size']      = '8000';
	    $config['max_width']     = '4024';

	    $this->upload->initialize($config);
	    $this->load->library('upload',$config);
	    $this->upload->do_upload('img');
	    $data   = $this->upload->data();

	    $id = $this->input->post('idproduk');
		$simpan = array(
					'idproduk'   => $this->input->post('idproduk'),
					'idkategori' => $this->input->post('kategori'),
					'idmerk'     => $this->input->post('merk'),
					'nama'       => $this->input->post('nama'),
					'warna'      => $this->input->post('warna'),
					'bahan'      => $this->input->post('bahan'),
					'deskripsi'  => $this->input->post('des'),
					'harga'      => $this->input->post('harga'),
					'foto'       => $data['file_name']);

		if(!empty($id)) {
			$gambar = $this->tokomodel->getproduk(array('idproduk' => $id))->row_array();
			unlink('assets/gambar/'.$gambar['foto']);
			$this->tokomodel->getubahproduk($simpan,$id);
		} else {
			$this->tokomodel->gettambahproduk($simpan);
		}

		redirect(base_url('admin/toko/tabelproduk'));
	}	

	public function simpankonfig() {
		$id = $this->input->post('id');
		$simpan = array(
					'id'     => $this->input->post('id'),
					'nama'   => $this->input->post('nama'),
					'email'  => $this->input->post('email'),
					'deskripsi'   => $this->input->post('deskripsi'),
					'telp'   => $this->input->post('telp'),
					'share1' => $this->input->post('share1'),
					'share2' => $this->input->post('share2'),
					'share3' => $this->input->post('share3'));

		$this->tokomodel->getsimpankonfig($simpan,$id);
		redirect(base_url('admin/toko/konfig'));
	}

	public function reset() {
		$id     = $this->uri->segment(4);
		$data   = $this->tokomodel->geteditkonfig($id)->row_array();
		$simpan = array(
					'id'        => $data['id'],
					'nama'      => 'Shop Cart',
					'email'     => 'shopcart@gmail.com',
					'telp'      => '0800 1234 678 ',
					'share1'    => 'www.facebook.com',
					'share2'    => 'twitter.com',
					'share3'    => 'instagram.com',
					'deskripsi' => 'The standard chunk of Lorem<br> The standard chunk of 
									Lorem Ipsum used since the 1500s is reproduced below for 
									those interested. Sections 1.10.32 and 1.10.33 from "de Finibus 
									Bonorum et Malorum" by Cicero are also reproduced in their exact 
									original form, accompanied by English versions from the 1914 
									translation by H. Rackham.');

		$this->tokomodel->getsimpankonfig($simpan,$id);
		redirect(base_url('admin/toko/konfig'));
	}

	public function simpanmenu() { //HALAMAN
		$idmenu  = $this->input->post('id');
		$hal = array(
				'idmenu'   => $this->input->post('id'),
				'namamenu' => $this->input->post('nama'));
		$this->tokomodel->getsimpanhalaman($hal,$idmenu);

		redirect(base_url('admin/toko/menu'));
	}

	public function simpankonten() { //HALAMAN
		$id  = $this->input->post('id');
		$konten = array(
				'id'        => $this->input->post('id'),
				'idmenu'    => $this->input->post('idmenu'),
				'judulhal'  => $this->input->post('judul'),
				'subjudul'  => $this->input->post('subjudul'),
				'deskripsi' => $this->input->post('des'));
		$this->tokomodel->getsimpankonten($konten,$id);

		redirect(base_url('admin/toko/konten'));
	}

	public function simpanfooter() { //HALAMAN
		$id  = $this->input->post('id');
		$konten = array(
				'id'        => $this->input->post('id'),
				'subjudul'  => $this->input->post('nama'),
				'deskripsi' => $this->input->post('tahun'));
		$this->tokomodel->getsimpankonten($konten,$id);

		echo "<script>alert('Footer Berhasil diUbah...');</script>";
		redirect(base_url('admin/toko/footer'));
	}

	public function simpanuser() { //USER ( TABEL ADMIN )
		$id = $this->input->post('idadmin');
		$simpan = array(
					'idadmin'     => $this->input->post('idadmin'),
					'username'    => $this->input->post('nama'),
					'namalengkap' => $this->input->post('namaleng'),
					'email'       => $this->input->post('email'),
					'password'    => $this->input->post('pass'));

		if (!empty($id)) {
			$this->tokomodel->getubahuser($simpan, $id);
		} else {
			$this->tokomodel->gettambahuser($simpan);
		}
		
		redirect(base_url('admin/toko/user'));
	}

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ END ~  |

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ EDIT DATA ~  |

	public function ubahcustomer() { //CUSTOMER
		$id = $this->input->post('user');
		$simpan = array(
					'idcustom'  => $this->input->post('user'),
					'title'     => $this->input->post('title'),
					'firstname' => $this->input->post('namad'),
					'lastname'  => $this->input->post('namab'),
					'email'     => $this->input->post('email'),
					'password'  => $this->input->post('pass'),
					'date'      => $this->input->post('ttl'));

		$this->tokomodel->getubah($simpan, $id);
		redirect(base_url('admin/toko/tabelcustomer'));
	}

	public function ubahkategori() { //KATEGORI
		$id = $this->input->post('idkategori');
		$simpan = array(
					'idkategori'   => $this->input->post('idkategori'),
					'namakategori' => $this->input->post('nama'));

		$this->tokomodel->getubahkat($simpan, $id);
		redirect(base_url('admin/toko/kategori'));
	}	

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ END ~  |

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ MENAMPILKAN DATA PADA FORM ~  |

	/*public function editcustomer() { //CUSTOMER
		$id = $this->uri->segment(4);
		$data['data']  = $this->tokomodel->getedit($id);
		$this->template->tampilan('admin/edit/editcustomer',$data);
	}*/

	public function editkategori() { //KATEGORI
		$id = $this->uri->segment(4);
		$data['data']  = $this->tokomodel->geteditkat($id);
		$this->template->tampilan('admin/edit/editkategori',$data);
	}

	public function editkonfig() { //KATEGORI
		$id = $this->uri->segment(4);
		$data['set']  = $this->tokomodel->geteditkonfig($id)->row_array();
		$this->template->tampilan('admin/setting/konfig',$data);
	}

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ END ~  |

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ HAPUS DATA ~  |

	public function hapuscustomer() { //Hapus data CUSTOMER
		$id = $this->uri->segment(4);
		$this->tokomodel->gethapusdetail($id);
		$this->tokomodel->gethapus($id);

		redirect(base_url('admin/toko/tabelcustomer'));
	}

	public function hapusorder() {
		$id = $this->uri->segment(4);
		$this->tokomodel->gethapusorder($id);
		$this->tokomodel->gethapusdetailorder($id);

		redirect(base_url('admin/toko/order'));
	}

	public function hapuskategori() { //Hapus data KATEGORI
		$id = $this->uri->segment(4);
		$this->tokomodel->gethapuskat($id);

		redirect(base_url('admin/toko/kategori'));
	}

	public function hapusmerk() { //Hapus data MERK
		$id = $this->uri->segment(4);
		$img = $this->tokomodel->getmerk(array('idmerk' => $id))->row_array();
		unlink('assets/gambar/'.$img['gambar']);
		$this->tokomodel->gethapusmerk($id);

		redirect(base_url('admin/toko/merk'));
	}

	public function hapusproduk() { //Hapus data PRODUK
		$id = $this->uri->segment(4);
		$img = $this->tokomodel->getproduk(array('idproduk' => $id))->row_array();
		unlink('./assets/gambar/'.$img['foto']);
		$this->tokomodel->gethapusproduk($id);

		redirect(base_url('admin/toko/tabelproduk'));
	}

	public function hapusadmin() { //Hapus data USER ( TABEL ADMIN )
		$id = $this->uri->segment(4);
		$this->tokomodel->gethapusadmin($id);

		redirect(base_url('admin/toko/user'));
	}

//<<<<<<<<<<<<<<<<<<<<<<<<<<<  ~ END ~ |

}
