<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pweb extends CI_Model
{
	function read(){
		$this->db->order_by('nama_mahasiswa', 'Asc');
		return $this->db->get('tbl_nilai')->result_array();
	}
	
	function create(){
		$nilai1 = $this->input->post('n_pert1');
		$nilai2 = $this->input->post('n_pert2');
		$nilai3 = $this->input->post('n_pert3');
		$nilai4 = $this->input->post('n_pert4');
		$nilai5 = $this->input->post('n_pert5');
		$rata = ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5)/5;
		if ($rata <= 75){
			$keterangan = "Tingkatkan lagi ayo semangat! Bismillah";
		} elseif ($rata >= 75){
			$keterangan = "Lulus dengan hasil yang baik, barakallah fii umrik";
		} else {
			$keterangan = "Nilai Tidak Valid";
		}

		$data = [
			'nama_mahasiswa' => $this->input->post('nama_mhs'),
			'nilai1' => $nilai1,
			'nilai2' => $nilai2,
			'nilai3' => $nilai3,
			'nilai4' => $nilai4,
			'nilai5' => $nilai5,
			'rata' => $rata,
			'keterangan' => $keterangan
		];

		$this->db->insert('tbl_nilai', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'Ditambah');
			redirect('Pweb', 'refresh');
		}
	}

	function get_row($id){
		return $this->db->get_where('tbl_nilai', ['id_nilai'=>$id])->row_array();
	}

	function update(){
		$nilai1 = $this->input->post('n_pert1');
		$nilai2 = $this->input->post('n_pert2');
		$nilai3 = $this->input->post('n_pert3');
		$nilai4 = $this->input->post('n_pert4');
		$nilai5 = $this->input->post('n_pert5');
		$rata = ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5)/5;
		if ($rata <= 75){
			$keterangan = "Tingkatkan lagi ayo semangat! Bismillah";
		} elseif ($rata >= 75){
			$keterangan = "Lulus dengan hasil yang baik, barakallah fii umrik";
		} else {
			$keterangan = "Nilai Tidak Valid";
		}

		$data = [
			'nama_mahasiswa' => $this->input->post('nama_mhs'),
			'nilai1' => $nilai1,
			'nilai2' => $nilai2,
			'nilai3' => $nilai3,
			'nilai4' => $nilai4,
			'nilai5' => $nilai5,
			'rata' => $rata,
			'keterangan' => $keterangan
		];

		$this->db->where('id_nilai', $this->input->post('id_nilai'));
		$this->db->update('tbl_nilai', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'Diubah');
			redirect('Pweb', 'refresh');
		}
	}

	function delete ($id) {
		$this->db->where('id_nilai', $id);
		$this->db->delete('tbl_nilai');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'Dihapus');
			redirect('Pweb', 'refresh');
		}
	}
}