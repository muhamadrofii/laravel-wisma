<!-- <?php

namespace App\Http\Controllers;

use App\Models\DiklatParticipant; // Model yang digunakan
use Illuminate\Http\Request;

class MasteruserController extends Controller
{
    /**
     * Menampilkan daftar masterusers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data DiklatParticipant
        $peserta = DiklatParticipant::with('user')->latest()->paginate(10); // Misalnya paginate 10

        return view('masterusers.index', compact('peserta'));
    }

    // Method lain sesuai kebutuhan
} -->
