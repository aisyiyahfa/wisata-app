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
        if ($request->hasFile('transfer_proof')) {    
            $file = $request->file('transfer_proof');    
            $fileName = time() . '_' . $file->getClientOriginalName();    
            $filePath = $file->storeAs('uploads/transfer_proofs', $fileName, 'public');    
            $donation->transfer_proof = $filePath; // Menyimpan path file    
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
            // Handle file upload and update logic here  
            if ($donation->transfer_proof) {  
                Storage::disk('public')->delete($donation->transfer_proof);  
            }  
   
            $file = $request->file('transfer_proof');  
            $fileName = time() . '_' . $file->getClientOriginalName();  
            $filePath = $file->storeAs('uploads/transfer_proofs', $fileName, 'public');  
            $donation->transfer_proof = $filePath;  
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
