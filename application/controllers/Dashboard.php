<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta'); //set waktu sesuai zona

		$this->load->model('m_data');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti user belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="telah_login"){
			redirect(base_url().'login?alert=belum_login');
		}
	}	

	public function index()
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		//SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// hitung jumlah fase
		$data['jumlah_fase'] = $this->m_data->get_data('fase')->num_rows();
		// hitung jumlah tugas
		$data['jumlah_tugas'] = $this->m_data->get_data('tugas')->num_rows();
		// hitung jumlah user
		$data['jumlah_user'] = $this->m_data->get_data('user')->num_rows();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_index',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function keluar()
	{
		$this->session->sess_destroy(); //destroy library buat keluar system jadi dari sananya sintaxnya
		redirect('login?alert=logout');
	}

	// CRUD PRETEST
	public function pretest()
	{
		//mengambil seluruh pretest data lewat model dari database 
		$data['pretest'] = $this->m_data->get_data('pretest')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pretest',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function pretest_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pretest_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pretest_aksi()
	{
		// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
		$this->form_validation->set_rules('pretest','pretest','required');

		
		if($this->form_validation->run() != false){
			//bakal nagkap nilai dari form validation, jika bernilai true 
			//jika bernilai false bakal ngeredirect ke halaman utama(tdk akan keinput datanya)

			//menangkap data pretest untuk ditampilkan
			$pretest = $this->input->post('pretest');

			$data = array(
				'questions' => $pretest,
			);

			//mengirim nilai dari form validasi
			$this->m_data->insert_data($data,'pretest');
			// kembali lagi ke halaman utama pretest
			redirect(base_url().'dashboard/pretest');
			
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pretest_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pretest_edit($id)
	{
		$where = array( // menangkap id
			'id_pretest' => $id
		);
		$data['pretest'] = $this->m_data->edit_data($where,'pretest')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pretest_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function pretest_update()
	{
		// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
		$this->form_validation->set_rules('pretest','pretest','required');

		if($this->form_validation->run() != false){

			// Ambil Id dan isi pretest dari form pretest
			$id = $this->input->post('id');
			$pretest = $this->input->post('pretest');

			$where = array(
				'id_pretest' => $id
			);

			$data = array(
				'questions' => $pretest,
			);

			$this->m_data->update_data($where, $data,'pretest');

			redirect(base_url().'dashboard/pretest');
			
		}else{

			$id = $this->input->post('id');
			$where = array(
				'id_pretest' => $id
			);
			$data['pretest'] = $this->m_data->edit_data($where,'pretest')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pretest_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pretest_hapus()
	{
		
		$pretest_hapus = $this->input->post('pretest_hapus');

		$where = array(
			'id_pretest' => $pretest_hapus
		);

		$this->m_data->delete_data($where,'pretest');
		//menampilkan sebuah notifikasi setelah melakukan proses
		$this->session->set_flashdata('deleted','true');
		redirect(base_url().'dashboard/pretest');
	}


// CRUD EVALUASI
public function evaluasi()
{
	//mengambil seluruh eval data lewat model dari database 
	$data['eval'] = $this->m_data->get_data('eval')->result();
	$this->load->view('dashboard/v_header');
	$this->load->view('dashboard/v_eval',$data);
	$this->load->view('dashboard/v_footer');
}

public function eval_tambah()
{
	$this->load->view('dashboard/v_header'); 
	$this->load->view('dashboard/v_eval_tambah');
	$this->load->view('dashboard/v_footer');
}

public function eval_aksi()
{
	// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
	$this->form_validation->set_rules('eval','eval','required');

	if($this->form_validation->run() != false){
		//bakal nagkap nilai dari form validation, jika bernilai true 
		//jika bernilai false bakal ngeredirect ke halaman utama(tdk akan keinput datanya)

		//menangkap data eval untuk ditampilkan
		$eval = $this->input->post('eval');

		$data = array(
			'pertanyaan' => $eval,
		);

		//mengirim nilai dari form validasi
		$this->m_data->insert_data($data,'eval');
		// kembali lagi ke halaman utama eval
		redirect(base_url().'dashboard/evaluasi');
		
	}else{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_eval_tambah');
		$this->load->view('dashboard/v_footer');
	}
}

public function eval_edit($id)
{
	$where = array(// menangkap id
		'id_eval' => $id
	);
	$data['eval'] = $this->m_data->edit_data($where,'eval')->result();
	$this->load->view('dashboard/v_header');
	$this->load->view('dashboard/v_eval_edit',$data);
	$this->load->view('dashboard/v_footer');
}

public function eval_update()
{
	// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
	$this->form_validation->set_rules('eval','eval','required');

	if($this->form_validation->run() != false){

		// Ambil Id dan isi eval dari form eval
		$id = $this->input->post('id');
		$eval = $this->input->post('eval');

		$where = array(
			'id_eval' => $id
		);

		$data = array(
			'pertanyaan' => $eval,
		);

		$this->m_data->update_data($where, $data,'eval');

		redirect(base_url().'dashboard/evaluasi');
		
	}else{

		$id = $this->input->post('id');
		$where = array(
			'id_eval' => $id
		);
		$data['eval'] = $this->m_data->edit_data($where,'eval')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pretest_edit',$data);
		$this->load->view('dashboard/v_footer');
	}
}

public function eval_hapus()
{
	$eval_hapus = $this->input->post('eval_hapus');

	$where = array(
		'id_eval' => $eval_hapus
	);

	$this->m_data->delete_data($where,'eval');

	//menampilkan sebuah notifikasi setelah melakukan proses
	$this->session->set_flashdata('deleted','true');
	
	redirect(base_url().'dashboard/evaluasi');
}

	// CRUD USER
	public function user()
	{
		$data['user'] = $this->m_data->get_data('user')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function user_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function user_aksi()
	{
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('email','Email User','required');
		$this->form_validation->set_rules('username','Username User','required');
		$this->form_validation->set_rules('password','Password User','required|min_length[8]');
		$this->form_validation->set_rules('level','Level User','required');
		$this->form_validation->set_rules('status','Status User','required');
		$this->form_validation->set_rules('kelas','Kelas');
		$this->form_validation->set_rules('nama_anggota','Nama Anggota');

		if($this->form_validation->run() != false){

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');
			$kelas = $this->input->post('kelas');
			$nama_anggota = $this->input->post('nama_anggota');

			$data = array(
				'user_nama' => $nama,
				'user_email' => $email,
				'user_username' => $username,
				'user_password' => $password,
				'user_level' => $level,
				'user_status' => $status,
				'kelas' => $kelas,
				'nama_anggota' => $nama_anggota
			);


			$this->m_data->insert_data($data,'user');

			redirect(base_url().'dashboard/user');	

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_user_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function user_edit($id)
	{
		$where = array(
			'user_id' => $id
		);
		$data['user'] = $this->m_data->edit_data($where,'user')->result();
		$this->load->view('dashboard/v_header');
	
		$this->load->view('dashboard/v_user_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function user_update()
	{
		$this->form_validation->set_rules('nama','Nama user','required');
		$this->form_validation->set_rules('email','Email user','required');
		$this->form_validation->set_rules('username','Username user','required');
		$this->form_validation->set_rules('level','Level user','required');
		$this->form_validation->set_rules('status','Status user','required');
		$this->form_validation->set_rules('kelas','Kelas');
		$this->form_validation->set_rules('nama_anggota','Nama Anggota');


		if($this->form_validation->run() != false){

			$id = $this->input->post('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');
			$kelas = $this->input->post('kelas');
			$nama_anggota = $this->input->post('nama_anggota');

			if($this->input->post('password') == ""){
				$data = array(
					'user_nama' => $nama,
					'user_email' => $email,
					'user_username' => $username,
					'user_level' => $level,
					'user_status' => $status,
					'kelas' => $kelas,
					'nama_anggota' => $nama_anggota
				);
			}else{
				$data = array(
					'user_nama' => $nama,
					'user_email' => $email,
					'user_username' => $username,
					'user_password' => $password,
					'user_level' => $level,
					'user_status' => $status,
					'kelas' => $kelas,
					'nama_anggota' => $nama_anggota
				);
			}
			
			$where = array(
				'user_id' => $id
			);

			$this->m_data->update_data($where,$data,'user');

			redirect(base_url().'dashboard/user');
		}else{
			$id = $this->input->post('id');
			$where = array(
				'user_id' => $id
			);
			$data['user'] = $this->m_data->edit_data($where,'user')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_user_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function user_hapus_aksi()
	{
		$user_hapus = $this->input->post('user_hapus');

		// hapus user
		$where = array(
			'user_id' => $user_hapus
		);

		$this->m_data->delete_data($where,'user');

		if ($this->db->affected_rows() <= 0){ // affected rows nya bakal <= 0 kalau syntax di atas gagal diekekusi (ada error)
			$this->session->set_flashdata('error','true');
			redirect(base_url().'dashboard/user');
		}else{ //kalau syntax berhasil dieksekusi berarti ada 1 row yang keubah atau kehapus
			$this->session->set_flashdata('deleted','true'); 
			redirect(base_url().'dashboard/user');
		}
	}

	public function detail($id)
	{
		$this->load->model('m_data');
		$detail = $this->m_data->detail_data($id);
		$data['detail'] = $detail;
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/detail',$data);
		$this->load->view('dashboard/v_footer');
	 }

	function cari(){
		$data['cariberdasarkan'] = $this->input->post("cariberdasarkan");
		$data['yangdicari'] = $this->input->post("yangdicari");

		$data['user'] = $this->m_data->cari($data['cariberdasarkan'],$data['yangdicari'])->result();
		$data['jumlah'] = count($data["user"]);
		$this->load->view('dashboard/v_header');
		$this->load->view("dashboard/v_user",$data);
		$this->load->view('dashboard/v_footer');
	}


	//CRUD FASE
	public function fase()
	{
		//mengambil seluruh data dari database lewat query ini
		$data['fase'] = $this->db->query("SELECT * FROM fase")->result();	// result nangkap data fase, nampung dan nampilin data
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_fase',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function fase_tambah()
	{
		//ngambil data dari database lewat query ini
		$data['fase'] = $this->m_data->get_data('fase')->result();
		// result nangkap data fase, nampung dan nampilin data
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_fase_tambah',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function fase_aksi()
	{
		// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
		$this->form_validation->set_rules('nama_fase','Nama_fase','required');
		$this->form_validation->set_rules('start_fase','Start_fase','required');
		$this->form_validation->set_rules('deadline','Deadline','required');

		if (empty($_FILES['modul']['name'])){
			// dokumentasi dari syntax upload dokumen
			//jika kosong, bisa ngisi modul, kalo suda ada tdk bisa ngisi
			$this->form_validation->set_rules('modul', 'Modul', 'required');
		}

		$this->form_validation->set_rules('lampiran','Lampiran');

		if($this->form_validation->run() != false){
			//bakal nagkap nilai dari form validation, jika bernilai true 
			//jika bernilai false bakal ngeredirect ke halaman utama(tdk akan keinput datanya)


			$config['upload_path']   = './upload/'; // (syntax dari userguid)
			$config['allowed_types'] = 'doc|docx|pdf|pptx'; //tipe2 apa aja yg boleh diinput

			$this->load->library('upload', $config); //fungsi buat upload, yang datanya diambil dari data upload path dan allowed 

			if ($this->upload->do_upload('modul')) { // nama field dalam database yang mau diupload
				//bakal nagkap nilai dari form validation, jika bernilai true 
				//jika bernilai false bakal ngeredirect ke halaman utama(tdk akan keinput datanya)

				// nangkap data upload yg udah dikirim lewat tampungan upload data
				$upload_data = $this->upload->data();

				// nangkap data yang diinput untuk ditampilin (post)
				
				$nama_fase = $this->input->post('nama_fase');
				$start_fase = $this->input->post('start_fase');
				$deadline = $this->input->post('deadline');
				$modul = $upload_data['file_name'];
				$lampiran = $this->input->post('lampiran');

				//udah ditangkap dimasukin ke parameter(array)
				$data = array(
					'nama_fase' => $nama_fase,
					'start_fase' => $start_fase,
					'deadline' => $deadline,
					'modul' => $modul,
					'lampiran' => $lampiran,
				);

				$this->m_data->insert_data($data,'fase'); //mengirim nilai dari form validasi

				redirect(base_url().'dashboard/fase');	// kembali lagi ke halaman utama fase
				
			} else {
				// jika syntax error, mengirim pesan kesalahan

				$this->form_validation->set_message('modul', $data['upload_data_error'] = $this->upload->display_errors());
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_fase_tambah',$data);
				$this->load->view('dashboard/v_footer');
			}

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_fase_tambah',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function fase_edit($id)
	{
		$where = array( // menangkap id
			'id_fase' => $id
		);
		$data['fase'] = $this->m_data->edit_data($where,'fase')->result(); //result : keseluruhan
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_fase_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function fase_update()
	{
		// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
		$this->form_validation->set_rules('nama_fase','Nama_fase','required');
		$this->form_validation->set_rules('start_fase','Start_fase','required');
		$this->form_validation->set_rules('deadline','Deadline','required');
		$this->form_validation->set_rules('lampiran','Lampiran');
		
		if($this->form_validation->run() != false){
			// Ambil Id fase dari form
			$id = $this->input->post('id');

			// Ambil data tsb dari form fase
			$nama_fase = $this->input->post('nama_fase');
			$start_fase = $this->input->post('start_fase');
			$deadline = $this->input->post('deadline');
			$lampiran = $this->input->post('lampiran');

			$where = array(
				'id_fase' => $id
			);

			$data = array(
				'nama_fase' => $nama_fase,
				'start_fase' => $start_fase,
				'deadline' => $deadline,
				'lampiran' => $lampiran,
			);

			$this->m_data->update_data($where,$data,'fase');


			if (!empty($_FILES['modul']['name'])){
				$config['upload_path']   = './upload/';
				$config['allowed_types'] = 'doc|docx|pdf|pptx';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('modul')) {

					$upload_data = $this->upload->data();

					$data = array(
						'modul' => $upload_data['file_name'],
					);

					$this->m_data->update_data($where,$data,'fase');

					redirect(base_url().'dashboard/fase');	

				} else {
					$this->form_validation->set_message('modul', $data['upload_data_error'] = $this->upload->display_errors());
					
					$where = array(
						'id_fase' => $id
					);
					$data['fase'] = $this->m_data->edit_data($where,'fase')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_fase_edit',$data);
					$this->load->view('dashboard/v_footer');
				}
			}else{
				redirect(base_url().'dashboard/fase');	
			}

		}else{
			$id = $this->input->post('id');
			$where = array(
				'id_fase' => $id
			);
			$data['fase'] = $this->m_data->edit_data($where,'fase')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_fase_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function fase_hapus_aksi()
	{
		$fase_hapus = $this->input->post('fase_hapus');
		
		// hapus fase berdasarkan array(id)
		$where = array(
			'id_fase' => $fase_hapus
		);

		
		$this->m_data->delete_data($where,'fase'); //syntax buat hapus fase
	
		if ($this->db->affected_rows() <= 0){ // jika affected rows <= 0, gagal dieksekusi
			// affected rows nya bakal <= 0 kalau syntax di atas gagal diekekusi (ada error)
			$this->session->set_flashdata('error','true');
			redirect(base_url().'dashboard/fase');
		}else{ //kalau syntax berhasil dieksekusi berarti ada 1 row yang keubah atau kehapus
			//menampilkan sebuah notifikasi setelah melakukan proses
			$this->session->set_flashdata('deleted','true'); //masukan kunci array yang ingin diambil, deleted = berisi data baru
			redirect(base_url().'dashboard/fase');
		}
	}

	public function download($id){
		$data = $this->db->get_where('fase',['id_fase' => $id])->row(); //nangkap data dari database, (nama database)
		// manggil dta dgn id
		force_download('upload/'.$data->modul,NULL); // syntx download (nama folder, dengan data, field modul)
	}

	public function ketentuan($id)
	{
		$this->load->model('m_data'); // menangkap id, masuk ke model(nama model)
		$ketentuan = $this->m_data->ketentuan_data($id); //variabel buat nangkap isi dari function ketentuan data yang ada di model data
		
		$data['ketentuan'] = $ketentuan; //nangkap data, dimasukin ke variabel ketentuan
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/ketentuan',$data);
		$this->load->view('dashboard/v_footer');
	 }

	 //CRUD TUGAS
	public function tugas()
	{
		//ngambil data dari database lewat query ini
		$data['tugas'] = $this->db->query("SELECT * FROM tugas INNER JOIN fase ON tugas.id_fase = fase.id_fase INNER JOIN user ON tugas.user_id = user.user_id")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_tugas',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function tugas_tambah()
	{
		//ngambil data dari database lewat query ini
		$data['fase'] = $this->m_data->get_data('fase')->result();
		// result nangkap data fase, nampung dan nampilin data
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_tugas_tambah',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function tugas_aksi()
	{
		// nangkap data lewat form, set rules (apa aja). kalo kosong gabisa diinput / ditangkap datanya
		$this->form_validation->set_rules('nama_fase','Nama_fase','required');

		if (!empty($_FILES['modul']['name'])) {
			// dokumentasi dari syntax upload dokumen
			//jika kosong, bisa ngisi jawaban, kalo suda ada tdk bisa ngisi
			$this->form_validation->set_rules('jawaban','Jawaban','required');
		}

		if ($this->form_validation->run() != false) {
			$config['upload_path']          = './tugasfase/';
			$config['allowed_types']        = 'doc|docx|pdf|pptx'; //tipe2 apa aja yg boleh diinput

			$this->load->library('upload', $config);
			if($this->upload->do_upload('jawaban')){ 
					$tugas_data = $this->upload->data();

					$waktu_pengumpulan = date('Y-m-d H:i:s'); 
					$fase = $this->input->post('nama_fase'); 
					$userid = $this->session->userdata('id'); 
					$jawaban = $tugas_data['file_name'];

					
					$data = array(
						'waktu_pengumpulan' => $waktu_pengumpulan,
						'id_fase' => $fase,
						'user_id' => $userid,
						'jawaban' => $jawaban,
					);

					$this->m_data->insert_data($data,'tugas'); 

					redirect(base_url().'dashboard/tugas');	
				} else {
					// jika syntax error, mengirim pesan kesalahan
					$this->form_validation->set_message('jawaban', $data['tugas_data_error'] = $this->upload->display_errors());
					$data['fase'] = $this->m_data->get_data('fase')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_tugas_tambah',$data);
					$this->load->view('dashboard/v_footer');
				}
		}else{
			$data['fase'] = $this->m_data->get_data('fase')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_tugas_tambah',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function tugas_edit($id)
	{
		$where = array( // menangkap id
			'id_tugas' => $id
		);
		$data['fase'] = $this->m_data->get_data('fase')->result(); 
		$data['tugas'] = $this->m_data->edit_data($where,'tugas')->row(); 
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_tugas_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function tugas_update()
	{
		$this->form_validation->set_rules('nama_fase','Nama_fase');
		
		if($this->form_validation->run() == false){
			
			// Ambil Id Tugas dari form
			$id = $this->input->post('id');

			// Ambil nama fase
			$fase = $this->input->post('nama_fase');

			$where = array(
				'id_tugas' => $id
			);

			$data = array(
				'id_fase' => $fase
			);

			$this->m_data->update_data($where,$data,'tugas');

			if (!empty($_FILES['jawaban']['name'])){
			
				$config['upload_path']   = './tugasfase/';
				$config['allowed_types'] = 'doc|docx|pdf|pptx';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('jawaban')) {

					$upload_data = $this->upload->data();

					$data = array(
						'jawaban' => $upload_data['file_name'],
					);

					$this->m_data->update_data($where,$data,'tugas');

					redirect(base_url().'dashboard/tugas');	

				} else {
					$this->form_validation->set_message('jawaban', $data['upload_data_error'] = $this->upload->display_errors());
					
					$where = array(
						'id_tugas' => $id
					);
					$data['tugas'] = $this->m_data->edit_data($where,'tugas')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_tugas_edit',$data);
					$this->load->view('dashboard/v_footer');
				}
			}else{
				redirect(base_url().'dashboard/tugas');	
			}

		}else{
			$id = $this->input->post('id');
			$where = array(
				'id_tugas' => $id
			);
			$data['tugas'] = $this->m_data->edit_data($where,'tugas')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_tugas_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function tugas_hapus_aksi()
	{
		$tugas_hapus = $this->input->post('tugas_hapus');

		// hapus tugas berdasarkan array(id)
		$where = array(
			'id_tugas' => $tugas_hapus
		);

		$this->m_data->delete_data($where,'tugas');

		//menampilkan sebuah notifikasi setelah melakukan proses
        $this->session->set_flashdata('deleted','true'); //masukan kunci array yang ingin diambil, deleted = berisi data baru
		redirect(base_url().'dashboard/tugas');
	}

	public function downloadTugas($id){
		$data = $this->db->get_where('tugas',['id_tugas' => $id])->row(); //nangkap data dari database, (nama database)
		// manggil dta dgn id
		force_download('tugasfase/'.$data->jawaban,NULL); // syntx download (nama folder, dengan data, field modul)
	}


	public function proses_tugas_nilai()
	{
		$id = $this->input->post('id');
		$this->form_validation->set_rules('nilai','Nilai','required');
		
		if($this->form_validation->run() == true){

			$nilai = $this->input->post('nilai');

			$where = array(
				'id_tugas' => $id
			);

			$data = array(
				'nilai' => $nilai
			);

			$this->m_data->update_data($where,$data,'tugas');

			redirect(base_url().'dashboard/tugas');	
		}else{
			redirect(base_url().'dashboard/tugas_nilai/'.$id);
		}
	}
	
	//isi form masuk view
	public function tugas_nilai($id){

		$where = array(
			'id_tugas' => $id
		);

		$data['tugas'] = $this->m_data->get_data('tugas')->result();
		$data['tugas'] = $this->m_data->edit_data($where,'tugas')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_tugas_nilai',$data);
		$this->load->view('dashboard/v_footer');
		
	}

	//CRUD PROFIL
	public function profil()
	{
		// id pengguna yang sedang login
		$id_user = $this->session->userdata('id');

		$where = array( //mengambil id
			'user_id' => $id_user
		);
		//mengambil data lewat models m data lalu masuk ke edit data, dgn sluruh element yg ada di user
		$data['profil'] = $this->m_data->edit_data($where,'user')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_profil',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function profil_update()
	{
		// Wajib isi nama dan email

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('email','Email','required');
		
		if($this->form_validation->run() != false){

			$id = $this->session->userdata('id');
			// Ambil nama dan email dari form
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			
			$where = array( //mengambil id
				'user_id' => $id
			);

			$data = array(
				'user_nama' => $nama,
				'user_email' => $email
			);

			$this->m_data->update_data($where,$data,'user');

			redirect(base_url().'dashboard/profil/?alert=sukses'); // pemberitahuan tanpa konfirmasi
		}else{
			// id user yang sedang login
			$id_user = $this->session->userdata('id');

			$where = array(
				'user_id' => $id_user
			);

			$data['profil'] = $this->m_data->edit_data($where,'user')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_profil',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pengaturan()
	{
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengaturan',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengaturan_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama','Nama Website','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi Website','required');
		$this->form_validation->set_rules('nomer_kontak','Nomer_kontak','required');
		$this->form_validation->set_rules('email_hubungi','Email_hubungi','required');

		if($this->form_validation->run() != false){

			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$nomer_kontak = $this->input->post('nomer_kontak');
			$email_hubungi = $this->input->post('email_hubungi');

			$where = array(

			);

			$data = array(
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'nomer_kontak' => $nomer_kontak,
				'email_hubungi' => $email_hubungi

			);

			// update pengaturan
			$this->m_data->update_data($where,$data,'pengaturan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['logo']['name'])){
				
				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('logo')) {
					// mengambil data tentang gambar logo yang diupload
					$gambar = $this->upload->data();

					$logo = $gambar['file_name'];
					
					$this->db->query("UPDATE pengaturan SET logo='$logo'");
				}
			}

			redirect(base_url().'dashboard/pengaturan/?alert=sukses');

		}else{
			$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengaturan',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	//PENGATURAN PASSWORD
	public function ganti_password()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/v_footer');
	}

	public function ganti_password_aksi()
	{

		// form validasi
		$this->form_validation->set_rules('password_lama','Password Lama','required');
		$this->form_validation->set_rules('password_baru','Password Baru','required|min_length[8]');
		$this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password Baru','required|matches[password_baru]');

		// cek validasi
		if($this->form_validation->run() != false){

			// menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			// cek kesesuaian password lama dengan id user yang sedang login dan password lama
			$where = array(
				'user_id' => $this->session->userdata('id'),
				'user_password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('user', $where)->num_rows();

			// cek kesesuaikan password lama
			if($cek > 0){

				// update data password user
				$w = array(
					'user_id' => $this->session->userdata('id')
				);
				$data = array(
					'user_password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'user');

				redirect('dashboard/ganti_password?alert=sukses');
			}else{
			
				redirect('dashboard/ganti_password?alert=gagal');
			}

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/v_footer');
		}

	}
}


/*Perintah $this->session->sess_destroy();
berguna untuk menghapus semua session yang telah dibuat pada saat pengguna login.
dan perintah redirect() bertujuan untuk mengalihkan halaman
redirect(‘login?alert=logout’) berarti mengalihkan halaman kembali ke halaman login ( controller Login.php ).
Sambil mengirimkan text “logout” pada parameter alert. */