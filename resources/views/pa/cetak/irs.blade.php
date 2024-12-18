<html>

<head>
    <style>
        h2 {
            text-align: center
        }

        .header {
            text-align: center;
            font-size: 12px;
            margin-bottom: 40px
        }

        .header p {
            margin-bottom: -12px
        }

        .title {
            text-align: center;
            font-size: 12px;
            margin-bottom: 40px
        }

        .title p {
            font-weight: bold;
            margin-bottom: -12px
        }

        .content {
            border-collapse: collapse;
            font-size: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 100%
        }

        .content table,
        .content td,
        .content th {
            border: .5px solid #000
        }

        .identitas {
            font-size: 11px
        }

        .ttd {
            font-size: 11px;
            margin-left: auto;
            margin-right: auto;
            width: 100%
        }

        div.relative {
            position: relative;
            width: 400px;
            height: 200px;
            border: 3px solid #73ad21
        }

        div.absolute {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 75px;
            height: 100px;
            border: .5px solid
        }

        @media print {
            @page {
                /*margin:  0mm;*/
                size: a4 portrait;
            }
        }

        @page {
            size: a4 portrait;
            /*margin: 0mm;*/
        }

        .center {
            text-align: center
        }
    </style>
    <script>
        window.print();
    </script>
    <title>Print IRS</title>
</head>

<body>
    @php
        $irs = $mhs->irs->first();
    @endphp
    <div class="absolute">
        <script data-pagespeed-no-defer="">
            //<![CDATA[
            (function() {
                for (var g = "function" == typeof Object.defineProperties ? Object.defineProperty : function(b, c, a) {
                            if (a.get || a.set) throw new TypeError("ES3 does not support getters and setters.");
                            b != Array.prototype && b != Object.prototype && (b[c] = a.value)
                        }, h = "undefined" != typeof window && window === this ? this : "undefined" != typeof global &&
                        null != global ? global : this, k = ["String", "prototype", "repeat"], l = 0; l < k.length -
                    1; l++) {
                    var m = k[l];
                    m in h || (h[m] = {});
                    h = h[m]
                }
                var n = k[k.length - 1],
                    p = h[n],
                    q = p ? p : function(b) {
                        var c;
                        if (null == this) throw new TypeError(
                            "The 'this' value for String.prototype.repeat must not be null or undefined");
                        c = this + "";
                        if (0 > b || 1342177279 < b) throw new RangeError("Invalid count value");
                        b |= 0;
                        for (var a = ""; b;)
                            if (b & 1 && (a += c), b >>>= 1) c += c;
                        return a
                    };
                q != p && null != q && g(h, n, {
                    configurable: !0,
                    writable: !0,
                    value: q
                });
                var t = this;

                function u(b, c) {
                    var a = b.split("."),
                        d = t;
                    a[0] in d || !d.execScript || d.execScript("var " + a[0]);
                    for (var e; a.length && (e = a.shift());) a.length || void 0 === c ? d[e] ? d = d[e] : d = d[e] = {} :
                        d[e] = c
                };

                function v(b) {
                    var c = b.length;
                    if (0 < c) {
                        for (var a = Array(c), d = 0; d < c; d++) a[d] = b[d];
                        return a
                    }
                    return []
                };

                function w(b) {
                    var c = window;
                    if (c.addEventListener) c.addEventListener("load", b, !1);
                    else if (c.attachEvent) c.attachEvent("onload", b);
                    else {
                        var a = c.onload;
                        c.onload = function() {
                            b.call(this);
                            a && a.call(this)
                        }
                    }
                };
                var x;

                function y(b, c, a, d, e) {
                    this.h = b;
                    this.j = c;
                    this.l = a;
                    this.f = e;
                    this.g = {
                        height: window.innerHeight || document.documentElement.clientHeight || document.body
                            .clientHeight,
                        width: window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
                    };
                    this.i = d;
                    this.b = {};
                    this.a = [];
                    this.c = {}
                }

                function z(b, c) {
                    var a, d, e = c.getAttribute("data-pagespeed-url-hash");
                    if (a = e && !(e in b.c))
                        if (0 >= c.offsetWidth && 0 >= c.offsetHeight) a = !1;
                        else {
                            d = c.getBoundingClientRect();
                            var f = document.body;
                            a = d.top + ("pageYOffset" in window ? window.pageYOffset : (document.documentElement || f
                                .parentNode || f).scrollTop);
                            d = d.left + ("pageXOffset" in window ? window.pageXOffset : (document.documentElement || f
                                .parentNode || f).scrollLeft);
                            f = a.toString() + "," + d;
                            b.b.hasOwnProperty(f) ? a = !1 : (b.b[f] = !0, a = a <= b.g.height && d <= b.g.width)
                        } a && (b.a.push(e), b.c[e] = !0)
                }
                y.prototype.checkImageForCriticality = function(b) {
                    b.getBoundingClientRect && z(this, b)
                };
                u("pagespeed.CriticalImages.checkImageForCriticality", function(b) {
                    x.checkImageForCriticality(b)
                });
                u("pagespeed.CriticalImages.checkCriticalImages", function() {
                    A(x)
                });

                function A(b) {
                    b.b = {};
                    for (var c = ["IMG", "INPUT"], a = [], d = 0; d < c.length; ++d) a = a.concat(v(document
                        .getElementsByTagName(c[d])));
                    if (a.length && a[0].getBoundingClientRect) {
                        for (d = 0; c = a[d]; ++d) z(b, c);
                        a = "oh=" + b.l;
                        b.f && (a += "&n=" + b.f);
                        if (c = !!b.a.length)
                            for (a += "&ci=" + encodeURIComponent(b.a[0]), d = 1; d < b.a.length; ++d) {
                                var e = "," + encodeURIComponent(b.a[d]);
                                131072 >= a.length + e.length && (a += e)
                            }
                        b.i && (e = "&rd=" + encodeURIComponent(JSON.stringify(B())), 131072 >= a.length + e.length && (a +=
                            e), c = !0);
                        C = a;
                        if (c) {
                            d = b.h;
                            b = b.j;
                            var f;
                            if (window.XMLHttpRequest) f = new XMLHttpRequest;
                            else if (window.ActiveXObject) try {
                                f = new ActiveXObject("Msxml2.XMLHTTP")
                            } catch (r) {
                                try {
                                    f = new ActiveXObject("Microsoft.XMLHTTP")
                                } catch (D) {}
                            }
                            f && (f.open("POST", d + (-1 == d.indexOf("?") ? "?" : "&") + "url=" + encodeURIComponent(b)), f
                                .setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), f.send(a))
                        }
                    }
                }

                function B() {
                    var b = {},
                        c;
                    c = document.getElementsByTagName("IMG");
                    if (!c.length) return {};
                    var a = c[0];
                    if (!("naturalWidth" in a && "naturalHeight" in a)) return {};
                    for (var d = 0; a = c[d]; ++d) {
                        var e = a.getAttribute("data-pagespeed-url-hash");
                        e && (!(e in b) && 0 < a.width && 0 < a.height && 0 < a.naturalWidth && 0 < a.naturalHeight || e in
                            b && a.width >= b[e].o && a.height >= b[e].m) && (b[e] = {
                            rw: a.width,
                            rh: a.height,
                            ow: a.naturalWidth,
                            oh: a.naturalHeight
                        })
                    }
                    return b
                }
                var C = "";
                u("pagespeed.CriticalImages.getBeaconData", function() {
                    return C
                });
                u("pagespeed.CriticalImages.Run", function(b, c, a, d, e, f) {
                    var r = new y(b, c, a, e, f);
                    x = r;
                    d && w(function() {
                        window.setTimeout(function() {
                            A(r)
                        }, 0)
                    })
                });
            })();
            pagespeed.CriticalImages.Run('/mod_pagespeed_beacon', 'http://siap.undip.ac.id/irs/mhs/irs/report_pdf',
                'mOI-HpltW2', true, false, '0kG92odJJuM');
            //]]>
        </script><img class="absolute"
            src="/images/mhs/{{ $mhs->foto }}"
            alt="foto.jpg" style="width: 75px;height: 100px;" data-pagespeed-url-hash="3322438973"
            onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
    </div>
    <div class="header">
        <p>SIMALAKAMA</p>
        <p>UNIVERSITAS DIPONEGORO</p>
    </div>
    <div class="title">
        <p>ISIAN RENCANA STUDI</p>
        <p>Semester {{ $irs->jenis_semester }} TA {{ $irs->tahun_ajaran }} </p>
    </div>
    <div>
        <table class="identitas">
            <tbody>
                <tr>
                    <td>NIM</td>
                    <td style="width: 5px;">:</td>
                    <td>{{ $mhs->nim }}</td>
                </tr>
                <tr>
                    <td style="width: 80px;">Nama Mahasiswa</td>
                    <td style="width: 5px;">:</td>
                    <td>{{ $mhs->nama }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td style="width: 5px;">:</td>
                    <td>{{ $mhs->prodi->nama }}</td>
                </tr>
                <tr>
                    <td>Dosen Wali</td>
                    <td style="width: 5px;">:</td>
                    <td>{{ $mhs->pembimbingAkademik->dosen->nama }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <table class="content" cellpadding="2">
            <thead>
                <tr>
                    <th style="width: 5px;">NO</th>
                    <th style="width: 40px;">KODE</th>
                    <th style="width: 200px;">MATA KULIAH</th>
                    <th style="width: 40px;">KELAS</th>
                    <th style="width: 40px;">SKS</th>
                    <th style="width: 60px;">RUANG</th>
                    <th style="width: 60px;">STATUS</th>
                    <th style="width: 200px;">NAMA DOSEN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($irs->irsDetails as $detail)
                    
                <tr>
                    <td rowspan="2" class="center">1</td>
                    <td>{{ $detail->kodemk }}</td>
                    <td>{{ $detail->mataKuliah->nama }}</td>
                    <td class="center">{{ $detail->jadwalKuliah->kelas }}</td>
                    <td class="center">{{ $detail->mataKuliah->sks }}</td>
                    <td class="center">
                    {{ $detail->jadwalKuliah->ruang->nama  }}<br>
                    </td>
                    <td class="center">{{ $detail->status }}</td>
                    <td>
                        @php
                            $dosens = $detail->mataKuliah->dosenPengampu;
                        @endphp
                        @if ($dosens)
                            
                        @foreach ($dosens as $dosen)
                        {{ $dosen->nama }}<br>
                        @endforeach
                        @else
                        Tidak ada Dosen Pengampu
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        {{ $detail->jadwalKuliah->hari }} pukul {{ $detail->jadwalKuliah->waktu_mulai }} - {{ $detail->jadwalKuliah->waktu_selesai }} </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div>
        <table class="ttd">
            <thead>
                <tr>
                    <th style="width:200px">&nbsp;</th>
                    <th style="width:200px">&nbsp;</th>
                    <th style="width:auto">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Semarang, {{ date('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Pembimbing Akademik (Dosen Wali)</td>
                    <td></td>
                    <td>Nama Mahasiswa,</td>
                </tr>
                <!--  <tr>
        <td colspan="3"></td>
      </tr> -->
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>{{ $mhs->pembimbingAkademik->dosen->nama }}</td>
                    <td></td>
                    <td>{{ $mhs->nama }}</td>
                </tr>
                <tr>
                    <td>NIDN. {{ $mhs->pembimbingAkademik->dosen->nidn }}</td>
                    <td></td>
                    <td>NIM. {{ $mhs->nim }}</td>
                </tr>
            </tbody>
        </table>
    </div>


</body>

</html>
