<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Keluarga - {{ $kepalaKeluarga->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 15px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header h2 {
            color: #64748b;
            margin: 5px 0 0 0;
            font-size: 14px;
            font-weight: normal;
        }

        .family-info {
            margin-bottom: 20px;
        }

        .info-section {
            margin-bottom: 15px;
        }

        .info-section h3 {
            color: #2563eb;
            font-size: 12px;
            font-weight: bold;
            margin: 0 0 8px 0;
            padding-bottom: 3px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 150px;
            font-weight: bold;
            padding: 3px 0;
            vertical-align: top;
        }

        .info-value {
            display: table-cell;
            padding: 3px 0;
            vertical-align: top;
        }

        .family-members {
            margin-top: 20px;
        }

        .family-members h3 {
            color: #2563eb;
            font-size: 12px;
            font-weight: bold;
            margin: 0 0 10px 0;
            padding-bottom: 3px;
            border-bottom: 1px solid #e5e7eb;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 9px;
            table-layout: fixed;
        }

        .table th {
            background-color: #f8fafc;
            color: #374151;
            font-weight: bold;
            padding: 6px 4px;
            text-align: left;
            border: 1px solid #e5e7eb;
            font-size: 9px;
        }

        .table td {
            padding: 4px 4px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
            word-wrap: break-word;
        }

        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-kepala {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-istri {
            background-color: #fce7f3;
            color: #be185d;
        }

        .status-anak {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-lain {
            background-color: #f3f4f6;
            color: #374151;
        }

        .gender-laki {
            color: #1e40af;
            font-weight: bold;
        }

        .gender-perempuan {
            color: #be185d;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }

        .photo-cell {
            width: 50px;
            text-align: center;
        }

        .photo-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .photo-placeholder {
            width: 40px;
            height: 40px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6px;
            color: #6b7280;
        }

        .family-photo {
            float: right;
            margin-left: 15px;
            margin-bottom: 10px;
        }

        .family-photo img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #2563eb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>YAYASAN [YAYASAN INDONESIA]</h1>
        <h2>Data Keluarga</h2>
    </div>

    <div class="family-info">
        <div class="info-section">
            <h3>Informasi Kepala Keluarga</h3>
            @if($kepalaKeluarga->foto)
                <div class="family-photo">
                    @php
                        $imagePath = public_path('storage/' . $kepalaKeluarga->foto);
                        $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
                        $mimeType = file_exists($imagePath) ? mime_content_type($imagePath) : 'image/jpeg';
                    @endphp
                    @if($imageData)
                        <img src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Foto {{ $kepalaKeluarga->nama_lengkap }}">
                    @endif
                </div>
            @endif
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">No. KK:</div>
                    <div class="info-value"><strong>{{ $kepalaKeluarga->no_kk }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Lengkap:</div>
                    <div class="info-value"><strong>{{ $kepalaKeluarga->nama_lengkap }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">NIK:</div>
                    <div class="info-value">{{ $kepalaKeluarga->nik }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin:</div>
                    <div class="info-value">
                        @if($kepalaKeluarga->jenis_kelamin == 'L' || $kepalaKeluarga->jenis_kelamin == 'Laki-laki')
                            <span class="gender-laki">Laki-laki</span>
                        @else
                            <span class="gender-perempuan">Perempuan</span>
                        @endif
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tempat/Tanggal Lahir:</div>
                    <div class="info-value">
                        {{ $kepalaKeluarga->tempat_lahir }}
                        @if ($kepalaKeluarga->tanggal_lahir)
                            , {{ $kepalaKeluarga->tanggal_lahir->format('d F Y') }}
                        @endif
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Pekerjaan:</div>
                    <div class="info-value">{{ $kepalaKeluarga->pekerjaan->nama_pekerjaan ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Telepon:</div>
                    <div class="info-value">{{ $kepalaKeluarga->no_telp ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Alamat:</div>
                    <div class="info-value">
                        {{ $kepalaKeluarga->desa ?? '-' }}, RT {{ $kepalaKeluarga->rt ?? '-' }}/RW {{ $kepalaKeluarga->rw ?? '-' }}<br>
                        {{ $kepalaKeluarga->kelurahan ?? '-' }}, {{ $kepalaKeluarga->kecamatan ?? '-' }}<br>
                        {{ $kepalaKeluarga->kabupaten ?? '-' }}, {{ $kepalaKeluarga->provinsi ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="family-members">
        <h3>Anggota Keluarga ({{ $anggotaKeluarga->count() }} orang)</h3>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30px; text-align: center;">No</th>
                    <th style="width: 50px; text-align: center;">Foto</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 100px;">NIK</th>
                    <th>Nama Lengkap</th>
                    <th style="width: 50px; text-align: center;">J.Kelamin</th>
                    <th style="width: 100px;">TTL</th>
                    <th style="width: 80px;">Pekerjaan</th>
                    <th style="width: 80px;">No. Telepon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotaKeluarga as $index => $anggota)
                    <tr class="{{ $anggota->status_kk == 'Kepala Keluarga' ? 'highlight-row' : '' }}">
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td class="photo-cell">
                            @if($anggota->foto)
                                @php
                                    $imagePath = public_path('storage/' . $anggota->foto);
                                    $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
                                    $mimeType = file_exists($imagePath) ? mime_content_type($imagePath) : 'image/jpeg';
                                @endphp
                                @if($imageData)
                                    <img src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Foto {{ $anggota->nama_lengkap }}" class="photo-img">
                                @else
                                    <div class="photo-placeholder">No Foto</div>
                                @endif
                            @else
                                <div class="photo-placeholder">No Foto</div>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge
                                @if($anggota->status_kk == 'Kepala Keluarga') status-kepala
                                @elseif($anggota->status_kk == 'Istri') status-istri
                                @elseif($anggota->status_kk == 'Anak') status-anak
                                @else status-lain @endif">
                                {{ $anggota->status_kk }}
                            </span>
                        </td>
                        <td class="no-wrap" style="font-family: monospace; font-size: 8px;">{{ $anggota->nik }}</td>
                        <td style="font-weight: bold;">{{ $anggota->nama_lengkap }}</td>
                        <td style="text-align: center;">
                            @if($anggota->jenis_kelamin == 'L' || $anggota->jenis_kelamin == 'Laki-laki')
                                <span class="gender-laki">L</span>
                            @else
                                <span class="gender-perempuan">P</span>
                            @endif
                        </td>
                        <td>
                            <div>{{ $anggota->tempat_lahir }}</div>
                            @if ($anggota->tanggal_lahir)
                                <div style="color: #6b7280; font-size: 7px;">{{ $anggota->tanggal_lahir->format('d/m/Y') }}</div>
                            @endif
                        </td>
                        <td>{{ $anggota->pekerjaan->nama_pekerjaan ?? '-' }}</td>
                        <td class="no-wrap">{{ $anggota->no_telp ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
        <p>Sistem Informasi Yayasan - Generated by Laravel</p>
    </div>
</body>
</html>