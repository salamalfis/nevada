<?php
function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        $menu_id = $queryMenu['id'];
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id, 'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);

    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function format_uang($number = 0, $acc = true)
{
    if ($acc) $acc = "Rp. ";
    return $acc . number_format($number, 0, ',', '.');
}
function setMsg($type, $msg)
{
    $ci = get_instance();
    $text = "";
    $text .= "<div class='alert alert-{$type}' alert-dismissible fade show' role='alert'>";
    $text .= $msg;
    $text .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $text .= "</div>";
    return $ci->session->set_flashdata('msg', $text);
}
function indo_date($date, $print_day = false)
{
    $day        = [1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $month      = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $split      = explode('-', $date);
    $nice_date  = $split[2] . ' ' . $month[(int) $split[1]] . ' ' . $split[0];

    if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $nice_date;
    }
    return $nice_date;
}
