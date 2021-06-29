<?php 

class M_data extends CI_Model{
	
	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}
	
	// FUNGSI CRUD
	// fungsi untuk mengambil data dari database
	function get_data($table){
		return $this->db->get($table);
	}

	// fungsi untuk menginput data ke database
	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	// fungsi untuk mengedit data
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	// fungsi untuk mengupdate atau mengubah data di database
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	// fungsi untuk menghapus data dari database
	function delete_data($where,$table){
		$this->db->delete($table,$where);
	}

	// fungsi detail user
	function detail_data($id)
	{
		$query = $this->db->get_where('user',['user_id' => $id])->row();
		return $query;

	}
	
	// fungsi ketentuan fase
	function ketentuan_data($id){
		$query = $this->db->get_where('fase',['id_fase' => $id])->row();
		return $query;
	}

	//fungsi cari data
	function cari($berdasarkan,$yangdicari){
		$this->db->from('user');

		switch ($berdasarkan) {
			case '':
				$this->db->like('user_nama',$yangdicari);
				$this->db->or_like('user_email',$yangdicari);
				$this->db->or_like('user_username',$yangdicari);
				$this->db->or_like('user_status',$yangdicari);
				$this->db->or_like('kelas',$yangdicari);
				$this->db->or_like('nama_anggota',$yangdicari);
				break;
			
			default:
				$this->db->like($berdasarkan,$yangdicari);
				break;
		}
		return $this->db->get();
	}
}

?>