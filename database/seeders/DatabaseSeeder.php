<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Document;
use Illuminate\Database\Seeder;
use App\Models\DocumentProgress;
use App\Models\DocumentWorkflow;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // Document Type
        $types = [
            ['kode' => 'SPK', 'nama' => 'Pembayaran Langsung dan Surat Perintah Kerja'],
            ['kode' => 'GUP', 'nama' => 'Ganti Uang Persediaan'],
            ['kode' => 'KKP', 'nama' => 'Kartu Kredit Pemerintah'],
        ];

        DB::table('document_types')->insert($types);


        // Workflow untuk SPK
        $workflowsA = [
            ['document_type_id' => 1, 'step_number' => 1, 'step_name' => 'Dokumen diterima', 'step_description' => 'Dokumen diterima petugas'],
            ['document_type_id' => 1, 'step_number' => 2, 'step_name' => 'Verifikasi Dokumen', 'step_description' => 'Dokumen diverifikasi'],
            ['document_type_id' => 1, 'step_number' => 3, 'step_name' => 'Pembuatan SPP', 'step_description' => 'Dokumen disetujui pimpinan'],
            ['document_type_id' => 1, 'step_number' => 4, 'step_name' => 'Validasi PPK', 'step_description' => 'Dokumen disetujui pimpinan'],
            ['document_type_id' => 1, 'step_number' => 5, 'step_name' => 'Cetak dan Validsi SPM', 'step_description' => 'Dokumen disetujui pimpinan'],
            ['document_type_id' => 1, 'step_number' => 6, 'step_name' => 'Diserahkan ke KPPN', 'step_description' => 'Dokumen disetujui pimpinan'],
            ['document_type_id' => 1, 'step_number' => 7, 'step_name' => 'Penerbitan SP2D', 'step_description' => 'Dokumen disetujui pimpinan'],
        ];

        // Workflow untuk GUP
        $workflowsB = [
            ['document_type_id' => 2, 'step_number' => 1, 'step_name' => 'Dokumen Diterima', 'step_description' => 'Surat masuk dicatat'],
            ['document_type_id' => 2, 'step_number' => 2, 'step_name' => 'Verifikasi Dokumen', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 3, 'step_name' => 'Pembuatan SPby', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 4, 'step_name' => 'Validasi PPK', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 5, 'step_name' => 'Pencatatan Modul Bendahara', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 6, 'step_name' => 'Pembuatan SPP', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 7, 'step_name' => 'Cetak dan Validasi SPM', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 8, 'step_name' => 'Diserahkan ke KPPN', 'step_description' => 'Surat masuk didistribusikan'],
            ['document_type_id' => 2, 'step_number' => 9, 'step_name' => 'Penerbitan SP2D', 'step_description' => 'Surat masuk didistribusikan'],
        ];

        // Workflow untuk KKP
        $workflowsC = [
            ['document_type_id' => 3, 'step_number' => 1, 'step_name' => 'Dokumen Diterima', 'step_description' => 'Membuat draft surat'],
            ['document_type_id' => 3, 'step_number' => 2, 'step_name' => 'Verifikasi Dokumen', 'step_description' => 'Surat direview'],
            ['document_type_id' => 3, 'step_number' => 3, 'step_name' => 'Pencatatan Modul Komitmen', 'step_description' => 'Surat dikirim'],
            ['document_type_id' => 3, 'step_number' => 4, 'step_name' => 'Pembuatan SPP', 'step_description' => 'Surat dikirim'],
            ['document_type_id' => 3, 'step_number' => 5, 'step_name' => 'Cetak dan Validasi SPM', 'step_description' => 'Surat dikirim'],
            ['document_type_id' => 3, 'step_number' => 6, 'step_name' => 'Diserahkan ke KPPN', 'step_description' => 'Surat dikirim'],
            ['document_type_id' => 3, 'step_number' => 7, 'step_name' => 'Penerbitan SP2D', 'step_description' => 'Surat dikirim'],
        ];

        DB::table('document_workflows')->insert(array_merge($workflowsA, $workflowsB, $workflowsC));

        $documents = Document::factory()->count(50)->create();

        foreach ($documents as $doc) {
            $workflows = DocumentWorkflow::where('document_type_id', $doc->jenis_id)
                ->orderBy('step_number')
                ->get();

            if ($workflows->isEmpty()) {
                continue;
            }

            $maxStepDone = rand(0, $workflows->count());


            foreach ($workflows as $wf) {
                $isChecked = $wf->step_number <= $maxStepDone;

                DocumentProgress::create([
                    'document_id' => $doc->id,
                    'workflow_id' => $wf->id,
                    'is_checked' => $isChecked,
                    'checked_at' => $isChecked ? Carbon::now()->subDays(rand(1, 30)) : null,
                    'description' => $isChecked ? "Step {$wf->step_number} selesai" : null,
                    'checked_by' => $isChecked ? 1 : null, 
                ]);
            }
        }
    }
}
