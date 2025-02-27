<?php  
    
namespace App\Http\Controllers;    
    
use App\Models\Donation;    
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Storage;    
    
class DonationController extends Controller    
{    
    // Menampilkan daftar donasi    
    public function index()    
    {    
        $donations = Donation::all();    
        return view('pages.user.index', ['donations' => $donations]);   
    }    
    
    // Menampilkan form untuk menambah donasi    
    public function create()    
    {    
        return view('donation.create');    
    }    
    
    public function store(Request $request)    
    {    
        // Validasi data yang diterima dari permintaan    
        $request->validate([    
            'name' => 'required|string|max:255',    
            'nominal' => 'required|numeric',    
            'date' => 'required|date',    
            'description' => 'nullable|string',    
            'transfer_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',    
        ]);    
        
        // Membuat donasi baru    
        $donation = new Donation();    
        $donation->name = $request->name;    
        $donation->nominal = $request->nominal;    
        $donation->date = $request->date;    
        $donation->description = $request->description;    
        
        // Menangani unggahan file untuk bukti transfer    
        // Menangani unggahan file untuk bukti transfer  
if ($request->hasFile('transfer_proof')) {  
    $file = $request->file('transfer_proof');  
    $fileName = time() . '_' . $file->getClientOriginalName();  
      
    // Simpan file di direktori yang benar  
    $filePath = $file->storeAs('storage/app/public/uploads/transfer_proofs', $fileName); // Simpan di storage/app/public/uploads/transfer_proofs  
  
    // Simpan path file tanpa 'public/' untuk database  
    $donation->transfer_proof = 'storage/app/public/uploads/transfer_proofs' . $fileName; // Simpan path relatif  
}  

        
        // Menyimpan donasi ke database    
        $donation->save();    
        
        return redirect()->route('donation.index')->with('success', 'Donasi berhasil ditambahkan!');    
    }    
      
      
    public function update(Request $request, $id)  
    {  
        $request->validate([  
            'name' => 'required|string|max:255',  
            'nominal' => 'required|numeric',  
            'date' => 'required|date',  
            'description' => 'nullable|string',  
            'transfer_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  
            'status' => 'required|string', // Ensure status is validated  
        ]);  
        $donation = Donation::findOrFail($id);    
        $donation->fill($request->except('transfer_proof'));    
          
        if ($request->hasFile('transfer_proof')) {    
            // Hapus file lama jika ada  
            if ($donation->transfer_proof) {    
                // Hapus file dari storage  
                Storage::disk('public')->delete($donation->transfer_proof);    
            }    
          
            // Proses unggahan file baru  
            $file = $request->file('transfer_proof');    
            $fileName = time() . '_' . $file->getClientOriginalName();    
            $filePath = $file->storeAs('storage/app/public/uploads/transfer_proofs', $fileName);  // Simpan di storage/app/public/uploads/transfer_proofs  
          
            // Simpan path relatif ke database  
            $donation->transfer_proof = 'storage/app/public/uploads/transfer_proofs' . $fileName;    
        }    
          
        $donation->save();  
   
        return redirect()->route('donation.index')->with('success', 'Donasi berhasil diperbarui!');  
    }  
 

    
    // Menghapus donasi    
    public function destroy($id)    
    {    
        $donation = Donation::findOrFail($id);    
        
        // Menghapus file bukti transfer jika ada    
        if ($donation->transfer_proof) {    
            Storage::disk('public')->delete($donation->transfer_proof);    
        }    
        
        $donation->delete();    
    
        return redirect()->route('donation.index')->with('success', 'Donasi berhasil dihapus!');    
    }    
}  
