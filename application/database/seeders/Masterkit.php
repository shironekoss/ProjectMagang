<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Masterkit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('MasterKit')->insert([
            [
                'kode_kit' => 'J STALL 1',
                'stall'=>1,
                'nama_kit' => 'KIT STALL 1 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Rangka Lantai ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Landasan',
                        'qty' => 9,
                    ],
                    [
                        'nama_komponen' => 'Landasan Modif',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket',
                        'qty' => 10,
                    ],
                    [
                        'nama_komponen' => 'Bracket Plendes',
                        'qty' => 10,
                    ],
                    [
                        'nama_komponen' => 'Plat 4x6',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Plat 4x4',
                        'qty' => 7,
                    ],
                    [
                        'nama_komponen' => 'Bracket Reservoir',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket Sekring',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket u/slanger baru',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PIPA SLANGER',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 2',
                'stall'=>2,
                'nama_kit' => 'KIT STALL 2 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Plat Lantai New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'BRACKET BUMPER DEPAN NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Lis Toilet',
                        'qty' => 2.5,
                    ],
                    [
                        'nama_komponen' => 'Pangkon Tangki BBM New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Baut BH 10x80',
                        'qty' => 8,
                    ],
                    [
                        'nama_komponen' => 'Baut NH 10',
                        'qty' => 8,
                    ],
                    [
                        'nama_komponen' => 'Ring WP 10',
                        'qty' => 16,
                    ],
                    [
                        'nama_komponen' => 'Ring WL 10',
                        'qty' => 8,
                    ],
                    [
                        'nama_komponen' => 'Baut BH 12x30',
                        'qty' => 30,
                    ],
                    [
                        'nama_komponen' => 'Baut NH Locknut 12mm',
                        'qty' => 30,
                    ],
                    [
                        'nama_komponen' => 'Ring WP 12 2mm',
                        'qty' => 60,
                    ],
                    [
                        'nama_komponen' => 'Kabel Aki New ELF',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 3',
                'stall'=>3,
                'nama_kit' => 'KIT STALL 3 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Panel RH Assy New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PENAHAN LUMPUR LH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PENAHAN LUMPUR RH NEW ELF',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Pintu Penumpang ke-1',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Pintu Penumpang ke-2',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Pintu BBM New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Plat Rumah Engsel Tutup Pintu BBM New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Pipa Kotak 1 lonjor (6 meter)',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Panel Atas',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'SAMBUNGAN PANEL NEW ELF RH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'SAMBUNGAN PANEL NEW ELF LH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT KAP',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'CAGAK PANEL NEW ELF PANJANG (KHUSUS 5P)',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Bibiran Slebor New ELF',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Engsel Sunduk',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Rumah Engsel Sunduk',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Rumah Engsel Pintu Samping LH Depan',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bibiran Wheel House',
                        'qty' => 2,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 4',
                'stall'=>4,
                'nama_kit' => 'KIT STALL 4 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'CAGAK PANEL NEW ELF PANJANG (KHUSUS 5P)',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'CAGAK PANEL NEW ELF SEDANG (KHUSUS 5P)',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'CAGAK PANEL NEW ELF PENDEK (KHUSUS 5P)',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bagasi Toolkit New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Rumah Engsel Tutup BBM',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Depan New ELF (1 Trap) Swing',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP DEPAN NEW ELF 1 TRAP SWING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP BELAKANG NEW ELF 1 TRAP SWING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Belakang New ELF (1 Trap) Swing',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP DEPAN NEW ELF 1 TRAP SWING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP BELAKANG NEW ELF 1 TRAP SWING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Depan New ELF (1 Trap) Sliding',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP DEPAN NEW ELF 1 TRAP SLIDING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP BELAKANG NEW ELF 1 TRAP SLIDING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Belakang New ELF (1 Trap) Sliding ',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP DEPAN NEW ELF 1 TRAP SLIDING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP TRAP BELAKANG NEW ELF 1 TRAP SLIDING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Depan New ELF (2 Trap) Swing',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TRAP ELF DEPAN SWING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TRAP ELF BELAKANG SWING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Belakang New ELF (2 Trap) Swing',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Depan New ELF (2 Trap) Sliding',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TRAP ELF DEPAN SLIDING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TRAP ELF BELAKANG SLIDING',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Trap Belakang New ELF (2 Trap) Sliding',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 5',
                'stall'=>5,
                'nama_kit' => 'KIT STALL 5 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'SEAT REAR BUMPER / SUPPORT BUMPER (NEW ELF) RH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'SEAT REAR BUMPER / SUPPORT BUMPER (NEW ELF) LH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Baut BH 10x20',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Ring WP 10',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Siku Penguat PBA Kiri',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Siku Penguat PBA Kanan',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Seat Bumper Belakang',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Baut BH 8x25',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Ring Plat WP 8Swing',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Pipa Penguat PBA New ELF',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Panel PBA Assy New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT CAGAK I',
                        'qty' => 3,
                    ],
                    [
                        'nama_komponen' => 'INNER PILLAR I (ELF)',
                        'qty' => 3,
                    ],
                    [
                        'nama_komponen' => 'Air Intake New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Pipa Air Intake New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Pilar B RH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'INNER PINTU STECKER LH NEW ELF',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'INNER PINTU SPASI LH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Pilar Stecker Bagian Atas',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Inner Pilar Sunduk Bagian Atas',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT CAGAK STECKER',
                        'qty' => 3,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT PANEL / SENDENGAN FUSO (KECIL)',
                        'qty' => 8,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT PANEL / SENDENGAN FUSO (BESAR)',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'PENYEKAT FILTER UDARA',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Kotak Hitam Besar Plat Penguat PBA',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Kotak Hitam Kecil Plat Penguat PBA',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Lis Toilet 1290',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Mur Tanam Stecker 5P',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Mur Tanam Stecker 4P',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Pintu Depan New ELF (dekat plat safety belt)',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 6',
                'stall'=>6,
                'nama_kit' => 'KIT STALL 6 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Roof Assy New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'CONNECTOR DEPAN NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'CONNECTOR KAP SHR RH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'CONNECTOR KAP SHR LH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Spanten baris 1 ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Spanten baris 2 ELF',
                        'qty' => 8,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT KAP',
                        'qty' => 3.25,
                    ],
                    [
                        'nama_komponen' => 'Sambungan Talangan Depan',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Sambungan Talangan Belakang',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'TUTUP MESIN ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Belakang Tutup Mesin RH New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner RH I',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Belakang Tutup Mesin LH New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Sambungan Knalpot ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Rumah Sabuk Pengaman',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Lis Toilet 1290',
                        'qty' => 2,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 7',
                'stall'=>7,
                'nama_kit' => 'KIT STALL 7 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Rangka Aki New ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Mur Tanam Rak Accu',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT ACCU BAWAH NEW ELF LONG',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT ACCU BELAKANG NEW ELF LONG',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT ACCU LH NEW ELF LONG',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT ACCU RH NEW ELF LONG',
                        'qty' => 8,
                    ],
                    [
                        'nama_komponen' => 'Baut Rumah Accu BH 8x25 (PERLU APA TIDAK?)',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Ring Plat WP 8 (PERLU APA TIDAK?)',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Mur Tanam NH 10 K8',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'FRAME HOUSING TUTUP BBM LH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'FRAME HOUSING TUTUP BBM RH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket Kunci Tutup BBM New ELF',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'INNER PILLAR BELAKANG PBA LH D-MAX',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'INNER PILLAR BELAKANG PBA RH D-MAX',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'TUTUP ENGSEL PBA NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'LUBANG KABEL LAMPU BELAKANG',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'BRACKET GAS SPRING',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Sambungan Panel Inner Belakang M30',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Penutup Rumah Lampu Bawah (Kerjain di  W?)',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Kotak Hitam Besar Plat Penguat PBA',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Crossil PBA LVD (nama komponennya apa?)',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 8',
                'stall'=>8,
                'nama_kit' => 'KIT STALL 8 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Tutup Kondensor',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'FRAME HOUSING TUTUP KONDENSOR LH NEW ELF',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'FRAME HOUSING TUTUP KONDENSOR RH NEW ELF',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Lis Toilet 1290',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Bibiran Slebor',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket Kondensor',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Pintu Bagasi Belakang Kiri',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Rangka Dalam Bagasi Kiri',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT BAGASI SAMPING BAWAH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT BAGASI SAMPING BELAKANG NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT BAGASI SAMPING LH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PLAT BAGASI SAMPING RH NEW ELF',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Karet Salon',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Sekrup TS 6',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Plat Karet SalonELF',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Jagrak Bagasi Samping',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'BRACKET BAN SEREP',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Rangka Inled AC',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Rangka Dudukan AC Kiri',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Rangka Dudukan AC Kanan',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Plat Bibiran AC',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket Pengikat Spanten',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Plat Hitam Penguat Kabin',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Cooling Unit',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket Plafon',
                        'qty' => 10,
                    ],
                    [
                        'nama_komponen' => 'Bracket Aluminium Plafon',
                        'qty' => 4,
                    ],
                    [
                        'nama_komponen' => 'Penguat Bracket Aluminium Plafon',
                        'qty' => 14,
                    ],
                    [
                        'nama_komponen' => 'Penguat Plafon Atas',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'BRACKET PLAFON ABS DEPAN NEW ELF',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 9',
                'stall'=>9,
                'nama_kit' => 'KIT STALL 9 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Inner Panel Bawah LH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Inner Panel Bawah RH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT PANEL ELF BESAR',
                        'qty' => 5,
                    ],
                    [
                        'nama_komponen' => 'PENGUAT PANEL / SENDENGAN FUSO (KECIL)',
                        'qty' => 5,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'kode_kit' => 'J STALL 10',
                'stall'=>10,
                'nama_kit' => 'KIT STALL 10 BODY WELDING',
                'komponen' => [
                    [
                        'nama_komponen' => 'Bracket Pegangan Tangan New ELF (NH6)',
                        'qty' => 2,
                    ],
                    [
                        'nama_komponen' => 'Bracket Stecker Pintu PBA',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Dudukan Stopper',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bracket Doorlock',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bibiran Karet PBA',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Bushing',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Lubang Knop RH',
                        'qty' => 1,
                    ],
                    [
                        'nama_komponen' => 'Lubang Knop LH',
                        'qty' => 1,
                    ],
                ],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
