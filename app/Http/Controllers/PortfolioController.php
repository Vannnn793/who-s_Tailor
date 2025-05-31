<?Php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = auth()->user()->portfolios;

        return response()->json([
            'message' => 'Daftar portofolio',
            'data' => $portfolios,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'skill' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('portfolios', 'public');
        }

        $portfolio = auth()->user()->portfolios()->create($data);

        return response()->json([
            'message' => 'Portofolio berhasil ditambahkan',
            'data' => $portfolio,
        ]);
    }

    public function update(Request $request, $id)
    {
        $portfolio = auth()->user()->portfolios()->findOrFail($id);

        $data = $request->validate([
            'skill' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return response()->json([
            'message' => 'Portofolio berhasil diperbarui',
            'data' => $portfolio,
        ]);
    }

    public function destroy($id)
    {
        $portfolio = auth()->user()->portfolios()->findOrFail($id);
        $portfolio->delete();

        return response()->json([
            'message' => 'Portofolio berhasil dihapus',
        ]);
    }
}
