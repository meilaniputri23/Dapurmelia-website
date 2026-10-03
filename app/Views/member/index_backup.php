<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akun Saya — Dapurmelia_</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
    :root{
      --cream:#FAF8F3;--beige:#F2EBE0;--tan:#E6D9C8;--sand:#D1BC9E;
      --gold:#C9A96E;--gold-dark:#A8843A;--brown:#7A5C3C;--dark:#2E1D0E;
      --text:#1E1208;--muted:#7A6652;--light:#A89480;--white:#FFFFFF;
      --serif:'Playfair Display',Georgia,serif;--sans:'Poppins',sans-serif;
      --ease:cubic-bezier(0.4,0,0.2,1);
      --green:#27ae60;--blue:#2980b9;--orange:#e67e22;--red:#e74c3c;
      --sidebar-w:245px;
    }
    html,body{height:100%;}
    body{font-family:var(--sans);background:#F0EBE3;color:var(--text);display:flex;min-height:100vh;overflow-x:hidden;}

    /* ══ SIDEBAR ════════════════════════════════════════ */
    .sidebar{width:var(--sidebar-w);flex-shrink:0;background:var(--dark);display:flex;flex-direction:column;position:fixed;top:0;left:0;bottom:0;z-index:100;overflow-y:auto;}
    .sb-logo{padding:1.7rem 1.4rem 1.3rem;border-bottom:1px solid rgba(255,255,255,0.08);}
    .sb-logo a{font-family:var(--serif);font-size:1.28rem;font-weight:700;color:var(--cream);text-decoration:none;display:block;}
    .sb-logo a em{font-style:normal;color:var(--gold);}
    .sb-logo span{font-size:0.59rem;color:rgba(255,255,255,0.28);letter-spacing:0.12em;text-transform:uppercase;margin-top:3px;display:block;}
    .sb-section{padding:1.1rem 0.9rem 0.35rem;font-size:0.57rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.2);}
    .sb-nav{list-style:none;padding:0 0.65rem;}
    .sb-nav li{margin-bottom:2px;}
    .sb-nav a{display:flex;align-items:center;gap:0.72rem;padding:0.63rem 0.85rem;border-radius:4px;font-size:0.79rem;font-weight:500;color:rgba(255,255,255,0.48);text-decoration:none;transition:all 0.2s;cursor:pointer;}
    .sb-nav a:hover{color:var(--cream);background:rgba(255,255,255,0.05);}
    .sb-nav a.on{color:var(--cream);background:rgba(201,169,110,0.15);font-weight:600;}
    .sb-nav a.on .si{color:var(--gold);}
    .si{font-size:0.95rem;width:20px;text-align:center;}
    .sb-badge{margin-left:auto;background:var(--red);color:var(--white);font-size:0.58rem;font-weight:700;padding:2px 6px;border-radius:10px;min-width:18px;text-align:center;}
    .sb-badge.gold{background:var(--gold-dark);}
    .sb-user{margin-top:auto;padding:1.1rem 1.2rem;border-top:1px solid rgba(255,255,255,0.07);display:flex;align-items:center;gap:0.72rem;}
    .sb-av{width:35px;height:35px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-family:var(--serif);font-weight:700;color:var(--dark);font-size:0.85rem;flex-shrink:0;}
    .sb-uname{font-size:0.78rem;font-weight:600;color:var(--cream);}
    .sb-urole{font-size:0.61rem;color:rgba(255,255,255,0.3);}
    .sb-out{margin-left:auto;font-size:0.85rem;color:rgba(255,255,255,0.22);cursor:pointer;text-decoration:none;transition:color 0.2s;}
    .sb-out:hover{color:var(--gold);}

    /* ══ MAIN ═══════════════════════════════════════════ */
    .main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}
    .topbar{background:var(--cream);border-bottom:1px solid var(--tan);padding:0 2rem;height:62px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
    .tb-title{font-family:var(--serif);font-size:1.12rem;font-weight:600;color:var(--dark);}
    .tb-sub{font-size:0.69rem;color:var(--muted);}
    .tb-right{display:flex;align-items:center;gap:0.8rem;}
    .tb-home{font-size:0.7rem;font-weight:600;letter-spacing:0.07em;text-transform:uppercase;color:var(--dark);background:var(--gold);padding:0.48rem 1rem;border-radius:2px;text-decoration:none;transition:all 0.2s;}
    .tb-home:hover{background:var(--gold-dark);color:var(--white);}
    /* Cart icon di topbar */
    .tb-cart{position:relative;cursor:pointer;background:var(--beige);border:1px solid var(--tan);border-radius:3px;padding:0.45rem 0.85rem;font-size:0.78rem;display:flex;align-items:center;gap:0.45rem;color:var(--dark);font-weight:600;transition:all 0.2s;}
    .tb-cart:hover{border-color:var(--gold);color:var(--gold-dark);}
    .cart-count{background:var(--red);color:var(--white);font-size:0.58rem;font-weight:700;padding:2px 6px;border-radius:10px;min-width:18px;text-align:center;display:none;}
    .content{padding:1.8rem 2rem;flex:1;}

    /* ══ VIEWS ═══════════════════════════════════════════ */
    .view{display:none;animation:vin 0.32s var(--ease);}
    .view.show{display:block;}
    @keyframes vin{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

    /* ══ WELCOME BANNER ══════════════════════════════════ */
    .welcome-banner{background:linear-gradient(135deg,var(--dark) 0%,#3D240F 100%);border-radius:8px;padding:1.7rem 2rem;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;position:relative;overflow:hidden;}
    .welcome-banner::after{content:'✦';position:absolute;right:1.5rem;font-size:9rem;color:rgba(201,169,110,0.05);line-height:1;top:50%;transform:translateY(-50%);}
    .wb-tag{font-size:0.64rem;font-weight:600;letter-spacing:0.15em;text-transform:uppercase;color:var(--gold);margin-bottom:0.3rem;}
    .wb-name{font-family:var(--serif);font-size:1.6rem;font-weight:700;color:var(--white);margin-bottom:0.25rem;}
    .wb-sub{font-size:0.78rem;color:rgba(255,255,255,0.42);}
    .wb-cta{background:var(--gold);color:var(--dark);font-size:0.71rem;font-weight:700;letter-spacing:0.09em;text-transform:uppercase;padding:0.65rem 1.3rem;border-radius:3px;border:none;cursor:pointer;transition:all 0.2s;flex-shrink:0;position:relative;z-index:1;}
    .wb-cta:hover{background:var(--gold-dark);color:var(--white);}

    /* ══ QUICK STATS ══════════════════════════════════════ */
    .qstats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;}
    .qs{background:var(--white);border:1px solid var(--tan);border-radius:7px;padding:1.05rem 1.2rem;display:flex;align-items:center;gap:0.85rem;transition:transform 0.2s,box-shadow 0.2s;}
    .qs:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(46,29,14,0.09);}
    .qs-ic{width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}
    .ic-g{background:rgba(201,169,110,0.15);}
    .ic-b{background:rgba(41,128,185,0.12);}
    .ic-gr{background:rgba(39,174,96,0.12);}
    .ic-o{background:rgba(230,126,34,0.12);}
    .qs-val{font-family:var(--serif);font-size:1.5rem;font-weight:700;color:var(--dark);line-height:1;}
    .qs-lbl{font-size:0.66rem;color:var(--muted);margin-top:2px;}

    /* ══ SHARED HELPERS ══════════════════════════════════ */
    .str{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;flex-wrap:wrap;gap:0.8rem;}
    .stitle{font-family:var(--serif);font-size:1.08rem;font-weight:600;color:var(--dark);}
    .btn-sm{font-size:0.67rem;font-weight:600;letter-spacing:0.07em;text-transform:uppercase;padding:0.46rem 1rem;border-radius:2px;cursor:pointer;border:none;background:var(--gold);color:var(--dark);transition:all 0.2s;}
    .btn-sm:hover{background:var(--gold-dark);color:var(--white);}
    .btn-sm-g{background:none;border:1px solid var(--tan);color:var(--muted);}
    .btn-sm-g:hover{border-color:var(--gold);color:var(--gold-dark);background:none;}
    .fgroup{margin-bottom:1rem;}
    .flabel{display:block;font-size:0.63rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--light);margin-bottom:0.4rem;}
    .finput,.fselect,.ftarea{width:100%;padding:0.7rem 0.9rem;border:1.5px solid var(--tan);border-radius:3px;background:var(--cream);color:var(--text);font-family:var(--sans);font-size:0.83rem;outline:none;transition:border-color 0.22s,box-shadow 0.22s;appearance:none;}
    .finput:focus,.fselect:focus,.ftarea:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,169,110,0.1);}
    .finput.err,.fselect.err{border-color:var(--red);}
    .ftarea{resize:vertical;min-height:78px;}
    .frow2{display:grid;grid-template-columns:1fr 1fr;gap:0.85rem;}
    .err-msg{font-size:0.69rem;color:var(--red);margin-top:3px;display:none;}

    /* ══ ORDER LIST CARDS (riwayat & beranda) ════════════ */
    .orders-list{display:flex;flex-direction:column;gap:0.8rem;}
    .ocard{background:var(--white);border:1px solid var(--tan);border-radius:7px;padding:1.1rem 1.3rem;transition:transform 0.2s,box-shadow 0.2s;}
    .ocard:hover{transform:translateX(3px);box-shadow:0 6px 20px rgba(46,29,14,0.08);}
    .ocard-top{display:flex;align-items:flex-start;gap:1rem;}
    .ocard-info{flex:1;min-width:0;}
    .ocard-title{font-family:var(--serif);font-size:0.92rem;font-weight:600;color:var(--dark);margin-bottom:2px;}
    .ocard-meta{font-size:0.71rem;color:var(--muted);}
    .ocard-right{text-align:right;flex-shrink:0;}
    .ocard-price{font-family:var(--serif);font-size:0.95rem;font-weight:700;color:var(--dark);}
    .ocard-date{font-size:0.64rem;color:var(--muted);margin-top:2px;}
    .ocard-actions{display:flex;gap:0.4rem;margin-top:7px;justify-content:flex-end;}
    /* Item thumbnails inside ocard */
    .ocard-items{display:flex;gap:0.4rem;margin-top:0.65rem;flex-wrap:wrap;align-items:center;}
    .item-thumb{width:34px;height:34px;border-radius:4px;object-fit:cover;border:2px solid var(--tan);}
    .item-more{width:34px;height:34px;border-radius:4px;background:var(--beige);border:1px solid var(--tan);display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:700;color:var(--muted);}

    /* Status */
    .sbadge{display:inline-flex;align-items:center;gap:0.35rem;font-size:0.64rem;font-weight:600;padding:0.24rem 0.62rem;border-radius:20px;margin-top:4px;}
    .s-new{background:rgba(41,128,185,0.1);color:#2471a3;}
    .s-proses{background:rgba(230,126,34,0.12);color:#ca6f1e;}
    .s-selesai{background:rgba(39,174,96,0.1);color:#1e8449;}
    .s-batal{background:rgba(231,76,60,0.08);color:#c0392b;}
    .s-siap{background:rgba(201,169,110,0.15);color:var(--gold-dark);}
    .dot-s{width:5px;height:5px;border-radius:50%;background:currentColor;}

    /* ══ PESAN PAGE: 2-PANEL LAYOUT ═══════════════════════
       Kiri: katalog menu | Kanan: keranjang + checkout     */
    .pesan-layout{display:grid;grid-template-columns:1fr 360px;gap:1.2rem;align-items:start;}

    /* ── Katalog ─────────────────────────────────────── */
    .catalog-wrap{background:var(--white);border:1px solid var(--tan);border-radius:8px;overflow:hidden;}
    .catalog-header{padding:1.1rem 1.4rem 0.9rem;border-bottom:1px solid var(--tan);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.8rem;}
    .catalog-title{font-family:var(--serif);font-size:1.05rem;font-weight:600;color:var(--dark);}
    .cat-tabs{display:flex;gap:0.35rem;flex-wrap:wrap;}
    .cat-tab{font-size:0.64rem;font-weight:600;letter-spacing:0.07em;text-transform:uppercase;padding:0.35rem 0.85rem;border:1px solid var(--tan);border-radius:2px;background:none;cursor:pointer;color:var(--muted);transition:all 0.2s;}
    .cat-tab.on,.cat-tab:hover{background:var(--dark);color:var(--cream);border-color:var(--dark);}
    .catalog-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:0.85rem;padding:1.2rem;}
    .menu-card{border:1.5px solid var(--tan);border-radius:6px;overflow:hidden;transition:all 0.22s;background:var(--cream);}
    .menu-card:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(46,29,14,0.1);border-color:var(--sand);}
    .menu-card img{width:100%;aspect-ratio:4/3;object-fit:cover;display:block;}
    .mc-body{padding:0.65rem 0.75rem 0.75rem;}
    .mc-cat{font-size:0.56rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--light);margin-bottom:2px;}
    .mc-name{font-family:var(--serif);font-size:0.88rem;font-weight:600;color:var(--dark);margin-bottom:1px;line-height:1.25;}
    .mc-price{font-size:0.72rem;font-weight:600;color:var(--gold-dark);margin-bottom:0.6rem;}
    /* Add-to-cart row inside card */
    .mc-action{display:flex;align-items:center;justify-content:space-between;gap:0.4rem;}
    .qty-ctrl{display:flex;align-items:center;gap:0.3rem;background:var(--beige);border-radius:3px;padding:2px;}
    .qb{width:24px;height:24px;border:none;background:none;cursor:pointer;font-size:0.95rem;font-weight:700;color:var(--dark);display:flex;align-items:center;justify-content:center;transition:color 0.15s;border-radius:2px;}
    .qb:hover{background:var(--tan);color:var(--gold-dark);}
    .qn{font-size:0.78rem;font-weight:700;color:var(--dark);min-width:20px;text-align:center;}
    .add-btn{font-size:0.63rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;background:var(--gold);color:var(--dark);border:none;border-radius:2px;padding:0.36rem 0.7rem;cursor:pointer;transition:all 0.2s;white-space:nowrap;}
    .add-btn:hover{background:var(--gold-dark);color:var(--white);}
    .add-btn.in-cart{background:var(--green);color:var(--white);}

    /* ── Cart Panel ──────────────────────────────────── */
    .cart-panel{background:var(--white);border:1px solid var(--tan);border-radius:8px;position:sticky;top:78px;}
    .cart-hd{padding:1.1rem 1.3rem 0.9rem;border-bottom:1px solid var(--tan);display:flex;align-items:center;justify-content:space-between;}
    .cart-hd-title{font-family:var(--serif);font-size:1rem;font-weight:600;color:var(--dark);display:flex;align-items:center;gap:0.5rem;}
    .cart-count-badge{background:var(--gold-dark);color:var(--white);font-size:0.62rem;font-weight:700;padding:2px 7px;border-radius:10px;}
    .cart-clear{font-size:0.65rem;color:var(--muted);cursor:pointer;border:none;background:none;transition:color 0.2s;}
    .cart-clear:hover{color:var(--red);}
    .cart-empty{padding:2.5rem 1.3rem;text-align:center;color:var(--muted);}
    .cart-empty span{font-size:2rem;display:block;margin-bottom:0.6rem;}
    .cart-empty p{font-size:0.78rem;}
    .cart-items{max-height:320px;overflow-y:auto;padding:0.7rem 1.3rem;}
    .cart-item{display:flex;align-items:center;gap:0.7rem;padding:0.65rem 0;border-bottom:1px solid rgba(230,217,200,0.5);}
    .cart-item:last-child{border-bottom:none;}
    .ci-img{width:44px;height:44px;border-radius:4px;object-fit:cover;flex-shrink:0;}
    .ci-info{flex:1;min-width:0;}
    .ci-name{font-size:0.78rem;font-weight:600;color:var(--dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .ci-price{font-size:0.67rem;color:var(--muted);}
    .ci-qty{display:flex;align-items:center;gap:0.25rem;background:var(--beige);border-radius:3px;padding:2px;}
    .cqb{width:22px;height:22px;border:none;background:none;cursor:pointer;font-size:0.85rem;font-weight:700;color:var(--dark);display:flex;align-items:center;justify-content:center;border-radius:2px;transition:background 0.15s;}
    .cqb:hover{background:var(--tan);}
    .cqn{font-size:0.75rem;font-weight:700;color:var(--dark);min-width:18px;text-align:center;}
    .ci-sub{font-size:0.73rem;font-weight:700;color:var(--dark);min-width:72px;text-align:right;flex-shrink:0;}
    .ci-del{background:none;border:none;cursor:pointer;color:rgba(200,150,150,0.6);font-size:0.85rem;padding:2px 4px;border-radius:2px;transition:all 0.15s;flex-shrink:0;}
    .ci-del:hover{color:var(--red);background:rgba(231,76,60,0.08);}
    /* Cart summary & checkout */
    .cart-summary{padding:0.9rem 1.3rem;border-top:1px solid var(--tan);background:var(--cream);border-radius:0 0 8px 8px;}
    .cs-row{display:flex;justify-content:space-between;font-size:0.78rem;color:var(--muted);margin-bottom:0.45rem;}
    .cs-row.grand{font-weight:700;font-size:0.9rem;color:var(--dark);border-top:1px solid var(--tan);padding-top:0.55rem;margin-top:0.3rem;}
    .cs-row.grand span:last-child{color:var(--gold-dark);}
    .checkout-btn{width:100%;padding:0.88rem;background:var(--gold-dark);color:var(--white);border:none;border-radius:3px;font-family:var(--sans);font-size:0.78rem;font-weight:700;letter-spacing:0.09em;text-transform:uppercase;cursor:pointer;transition:all 0.3s;box-shadow:0 4px 16px rgba(168,132,58,0.35);margin-top:0.8rem;display:flex;align-items:center;justify-content:center;gap:0.5rem;}
    .checkout-btn:hover{background:var(--dark);transform:translateY(-2px);}
    .checkout-btn:disabled{background:var(--sand);cursor:not-allowed;transform:none;box-shadow:none;}
    .promo-tag{background:rgba(39,174,96,0.1);color:var(--green);font-size:0.67rem;font-weight:600;padding:0.22rem 0.55rem;border-radius:10px;}

    /* ══ STEP FLOW: DETAIL + KONFIRMASI ══════════════════ */
    .flow-wrap{background:var(--white);border:1px solid var(--tan);border-radius:8px;overflow:hidden;}
    .flow-steps{display:flex;background:var(--beige);border-bottom:1px solid var(--tan);}
    .fs{flex:1;padding:0.85rem 0.5rem;text-align:center;font-size:0.65rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--muted);transition:all 0.3s;}
    .fs.on{color:var(--gold-dark);background:var(--cream);}
    .fs.done{color:var(--green);}
    .fs-num{display:inline-flex;width:19px;height:19px;border-radius:50%;border:1.5px solid var(--sand);align-items:center;justify-content:center;font-size:0.62rem;margin-right:5px;transition:all 0.3s;}
    .fs.on .fs-num{background:var(--gold-dark);border-color:var(--gold-dark);color:var(--white);}
    .fs.done .fs-num{background:var(--green);border-color:var(--green);color:var(--white);}
    .flow-panel{display:none;padding:1.8rem 2rem;}
    .flow-panel.show{display:block;}
    .flow-nav{display:flex;justify-content:space-between;align-items:center;margin-top:1.5rem;padding-top:1.1rem;border-top:1px solid var(--tan);}
    .flow-next{padding:0.8rem 1.9rem;background:var(--gold);color:var(--dark);border:none;border-radius:3px;font-family:var(--sans);font-size:0.75rem;font-weight:700;letter-spacing:0.09em;text-transform:uppercase;cursor:pointer;transition:all 0.3s;box-shadow:0 4px 14px rgba(201,169,110,0.35);}
    .flow-next:hover{background:var(--gold-dark);color:var(--white);transform:translateY(-2px);}
    .flow-back{padding:0.8rem 1.3rem;background:none;color:var(--muted);border:1.5px solid var(--tan);border-radius:3px;font-family:var(--sans);font-size:0.75rem;font-weight:600;cursor:pointer;transition:all 0.25s;}
    .flow-back:hover{border-color:var(--gold);color:var(--gold-dark);}

    /* Order items table inside confirm step */
    .oi-table{width:100%;border-collapse:collapse;margin-bottom:1.1rem;}
    .oi-table th{font-size:0.61rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);padding:0.65rem 0.8rem;text-align:left;border-bottom:1px solid var(--tan);background:var(--beige);}
    .oi-table td{font-size:0.8rem;padding:0.8rem 0.8rem;border-bottom:1px solid rgba(230,217,200,0.5);color:var(--dark);vertical-align:middle;}
    .oi-table tr.total-row td{font-weight:700;border-bottom:none;padding-top:0.9rem;}

    .confirm-box{background:var(--beige);border:1px solid var(--tan);border-radius:5px;padding:1.1rem 1.3rem;margin-bottom:1rem;}
    .cb-row{display:flex;justify-content:space-between;font-size:0.8rem;color:var(--muted);margin-bottom:0.45rem;}
    .cb-row:last-child{margin-bottom:0;}
    .cb-row.total{font-weight:700;font-size:0.88rem;color:var(--dark);border-top:1px solid var(--tan);padding-top:0.55rem;margin-top:0.35rem;}
    .cb-row.total span:last-child{color:var(--gold-dark);}

    /* ══ STATUS STEPPER (drawer) ══════════════════════════ */
    .stepper{display:flex;align-items:flex-start;margin:1.3rem 0;}
    .step{flex:1;display:flex;flex-direction:column;align-items:center;position:relative;}
    .step:not(:last-child)::after{content:'';position:absolute;top:14px;left:calc(50% + 14px);right:calc(-50% + 14px);height:2px;background:var(--tan);}
    .step.done:not(:last-child)::after{background:var(--gold);}
    .step-dot{width:28px;height:28px;border-radius:50%;border:2px solid var(--tan);background:var(--white);display:flex;align-items:center;justify-content:center;font-size:0.75rem;position:relative;z-index:1;transition:all 0.3s;}
    .step.done .step-dot{background:var(--gold);border-color:var(--gold);color:var(--white);}
    .step.active .step-dot{background:var(--white);border-color:var(--gold-dark);color:var(--gold-dark);box-shadow:0 0 0 4px rgba(201,169,110,0.15);}
    .step-lbl{font-size:0.59rem;color:var(--muted);margin-top:5px;text-align:center;font-weight:500;line-height:1.3;}
    .step.done .step-lbl,.step.active .step-lbl{color:var(--gold-dark);font-weight:600;}

    /* ══ MODAL: SUCCESS ══════════════════════════════════ */
    .modal-overlay{position:fixed;inset:0;background:rgba(30,18,8,0.55);z-index:500;display:flex;align-items:center;justify-content:center;padding:1.5rem;backdrop-filter:blur(4px);opacity:0;pointer-events:none;transition:opacity 0.35s var(--ease);}
    .modal-overlay.show{opacity:1;pointer-events:all;}
    .modal{background:var(--white);border-radius:10px;padding:2.4rem 2rem;max-width:430px;width:100%;text-align:center;transform:translateY(20px) scale(0.96);transition:transform 0.35s var(--ease);box-shadow:0 30px 80px rgba(30,18,8,0.25);}
    .modal-overlay.show .modal{transform:translateY(0) scale(1);}
    .modal-icon{width:68px;height:68px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-size:1.7rem;margin:0 auto 1.2rem;}
    .modal-title{font-family:var(--serif);font-size:1.45rem;font-weight:700;color:var(--dark);margin-bottom:0.45rem;}
    .modal-sub{font-size:0.8rem;color:var(--muted);line-height:1.7;margin-bottom:1.2rem;}
    .modal-id{display:inline-block;background:var(--beige);border:1px solid var(--tan);border-radius:4px;padding:0.45rem 1.1rem;font-family:var(--serif);font-size:1rem;font-weight:700;color:var(--gold-dark);letter-spacing:0.05em;margin-bottom:1.2rem;}
    /* Item preview in modal */
    .modal-items{background:var(--beige);border-radius:5px;padding:0.8rem 1rem;text-align:left;margin-bottom:1.2rem;max-height:150px;overflow-y:auto;}
    .mi-row{display:flex;align-items:center;gap:0.6rem;padding:0.3rem 0;font-size:0.78rem;color:var(--dark);}
    .mi-row img{width:30px;height:30px;border-radius:3px;object-fit:cover;flex-shrink:0;}
    .mi-row span{flex:1;}
    .mi-row strong{color:var(--gold-dark);}
    .modal-steps{background:var(--beige);border-radius:5px;padding:0.85rem 1rem;text-align:left;margin-bottom:1.3rem;}
    .mstep{display:flex;align-items:flex-start;gap:0.65rem;font-size:0.77rem;color:var(--muted);margin-bottom:0.45rem;}
    .mstep:last-child{margin-bottom:0;}
    .mstep-n{width:19px;height:19px;border-radius:50%;background:var(--gold);color:var(--dark);font-size:0.62rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;}
    .modal-btn-row{display:flex;gap:0.65rem;}
    .modal-btn{flex:1;padding:0.78rem;border-radius:3px;border:none;font-family:var(--sans);font-size:0.73rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;cursor:pointer;transition:all 0.25s;}
    .modal-btn.primary{background:var(--gold);color:var(--dark);}
    .modal-btn.primary:hover{background:var(--gold-dark);color:var(--white);}
    .modal-btn.secondary{background:var(--beige);border:1.5px solid var(--tan);color:var(--muted);}
    .modal-btn.secondary:hover{border-color:var(--gold);color:var(--gold-dark);}

    /* ══ DRAWER: DETAIL ══════════════════════════════════ */
    .drawer-overlay{position:fixed;inset:0;background:rgba(30,18,8,0.45);z-index:400;display:flex;justify-content:flex-end;opacity:0;pointer-events:none;transition:opacity 0.3s;}
    .drawer-overlay.show{opacity:1;pointer-events:all;}
    .drawer{background:var(--white);width:430px;max-width:95vw;height:100%;overflow-y:auto;padding:1.8rem;transform:translateX(100%);transition:transform 0.35s var(--ease);}
    .drawer-overlay.show .drawer{transform:translateX(0);}
    .drawer-close{float:right;background:var(--beige);border:1px solid var(--tan);border-radius:50%;width:31px;height:31px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:0.88rem;transition:all 0.2s;}
    .drawer-close:hover{background:var(--tan);}
    .drawer-title{font-family:var(--serif);font-size:1.18rem;font-weight:700;color:var(--dark);margin-bottom:1.3rem;clear:both;}
    .d-section{margin-bottom:1.2rem;}
    .d-label{font-size:0.6rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--light);margin-bottom:0.5rem;}
    .d-row{display:flex;justify-content:space-between;font-size:0.8rem;padding:0.42rem 0;border-bottom:1px solid rgba(230,217,200,0.4);color:var(--muted);}
    .d-row:last-child{border-bottom:none;}
    .d-row span:last-child{font-weight:600;color:var(--dark);}
    .cancel-btn{width:100%;padding:0.78rem;margin-top:1rem;background:rgba(231,76,60,0.08);color:var(--red);border:1.5px solid rgba(231,76,60,0.2);border-radius:3px;font-family:var(--sans);font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;cursor:pointer;transition:all 0.2s;}
    .cancel-btn:hover{background:rgba(231,76,60,0.15);}

    /* ══ PROFILE ══════════════════════════════════════════ */
    .profile-wrap{display:grid;grid-template-columns:250px 1fr;gap:1.2rem;align-items:start;}
    .profile-card{background:var(--white);border:1px solid var(--tan);border-radius:8px;padding:1.5rem;}
    .pf-av{width:66px;height:66px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-family:var(--serif);font-weight:700;color:var(--dark);font-size:1.65rem;margin-bottom:0.9rem;}
    .pf-name{font-family:var(--serif);font-size:1.1rem;font-weight:600;color:var(--dark);}
    .pf-email{font-size:0.76rem;color:var(--muted);margin-top:2px;margin-bottom:1rem;}
    .pf-stat{display:flex;gap:1rem;padding:0.85rem 0;border-top:1px solid var(--tan);border-bottom:1px solid var(--tan);margin-bottom:0.9rem;}
    .pf-stat-item{text-align:center;flex:1;}
    .pf-stat-val{font-family:var(--serif);font-size:1.1rem;font-weight:700;color:var(--dark);}
    .pf-stat-lbl{font-size:0.61rem;color:var(--muted);}
    .pf-since{font-size:0.71rem;color:var(--muted);}

    /* Empty state */
    .empty{text-align:center;padding:2.8rem;color:var(--muted);}
    .empty span{font-size:2.2rem;display:block;margin-bottom:0.7rem;}
    .empty p{font-size:0.82rem;margin-bottom:0.9rem;}

    /* Promo banner */
    .promo-banner{background:linear-gradient(90deg,var(--gold-dark),var(--gold));border-radius:7px;padding:1.1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-top:1.3rem;}
    .pb-tag{font-size:0.62rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:rgba(255,255,255,0.75);}
    .pb-title{font-family:var(--serif);font-size:1rem;font-weight:700;color:var(--white);margin-top:2px;}
    .pb-btn{background:var(--white);color:var(--gold-dark);font-size:0.69rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;padding:0.52rem 1.1rem;border-radius:2px;border:none;cursor:pointer;flex-shrink:0;transition:all 0.2s;}
    .pb-btn:hover{background:var(--cream);}

    @media(max-width:1100px){.pesan-layout{grid-template-columns:1fr;}.cart-panel{position:static;}}
    @media(max-width:960px){.qstats{grid-template-columns:1fr 1fr;}.profile-wrap{grid-template-columns:1fr;}.frow2{grid-template-columns:1fr;}}
    @media(max-width:768px){.sidebar{transform:translateX(-100%);}.main{margin-left:0;}}
    @media(max-width:600px){.qstats{grid-template-columns:1fr 1fr;}.content{padding:1.2rem 1rem;}.catalog-grid{grid-template-columns:1fr 1fr;}.flow-panel{padding:1.2rem;}}
  </style>
</head>
<body>

<!-- ══ SIDEBAR ══════════════════════════════════════════════ -->
<aside class="sidebar">
  <div class="sb-logo">
    <a href="/dapurmelia/">Dapur<em>melia</em>_</a>
    <span>Member Area</span>
  </div>
  <div class="sb-section">Menu</div>
  <ul class="sb-nav">
    <li><a class="on" onclick="sv('beranda')"><span class="si">🏠</span>Beranda</a></li>
    <li><a onclick="sv('pesan')"><span class="si">🛒</span>Buat Pesanan <span class="sb-badge gold" id="cartBadgeSb" style="display:none;">0</span></a></li>
    <li><a onclick="sv('riwayat')"><span class="si">📋</span>Riwayat Pesanan <span class="sb-badge" id="notifBadge" style="display:none;">0</span></a></li>
    <li><a onclick="sv('profil')"><span class="si">👤</span>Profil Saya</a></li>
  </ul>
  <div class="sb-section">Info</div>
  <ul class="sb-nav">
    <li><a href="/dapurmelia/?page=home#menu"><span class="si">🍱</span>Lihat Katalog</a></li>
  </ul>
  <div class="sb-user">
    <div class="sb-av" id="sbAv">?</div>
    <div>
      <div class="sb-uname" id="sbName">Pelanggan</div>
      <div class="sb-urole">Member</div>
    </div>
    <a href="?page=auth&action=logoutDirect" class="sb-out" title="Keluar">⎋</a>
  </div>
</aside>

<!-- ══ MAIN ════════════════════════════════════════════════ -->
<div class="main">
  <div class="topbar">
    <div>
      <div class="tb-title" id="tbTitle">Beranda</div>
      <div class="tb-sub"  id="tbSub">Selamat datang kembali</div>
    </div>
    <div class="tb-right">
      <div class="tb-cart" onclick="sv('pesan')">
        🛒 Keranjang <span class="cart-count" id="cartCountTop">0</span>
      </div>
      <a href="/dapurmelia/" class="tb-home">← Ke Toko</a>
    </div>
  </div>

  <div class="content">

    <!-- ══════════════════════════════════════════════════
         VIEW: BERANDA
    ══════════════════════════════════════════════════ -->
    <div class="view show" id="view-beranda">
      <div class="welcome-banner">
        <div>
          <div class="wb-tag">Selamat Datang Kembali ✦</div>
          <div class="wb-name" id="wbName">Pelanggan</div>
          <div class="wb-sub">Siap memesan untuk acara spesial hari ini?</div>
        </div>
        <button class="wb-cta" onclick="sv('pesan')">✦ &nbsp;Buat Pesanan Baru</button>
      </div>
      <div class="qstats">
        <div class="qs"><div class="qs-ic ic-b">🛒</div><div><div class="qs-val" id="statTotal">0</div><div class="qs-lbl">Total Pesanan</div></div></div>
        <div class="qs"><div class="qs-ic ic-gr">✅</div><div><div class="qs-val" id="statSelesai">0</div><div class="qs-lbl">Pesanan Selesai</div></div></div>
        <div class="qs"><div class="qs-ic ic-o">⏳</div><div><div class="qs-val" id="statProses">0</div><div class="qs-lbl">Sedang Diproses</div></div></div>
        <div class="qs"><div class="qs-ic ic-g">💰</div><div><div class="qs-val" id="statBelanja">Rp 0</div><div class="qs-lbl">Total Belanja</div></div></div>
      </div>
      <div class="str">
        <div class="stitle">Pesanan Terbaru</div>
        <button class="btn-sm btn-sm-g" onclick="sv('riwayat')">Lihat Semua →</button>
      </div>
      <div class="orders-list" id="berandaOrders">
        <div class="empty"><span>🛒</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Buat Pesanan Pertama →</button></div>
      </div>
      <div class="promo-banner">
        <div><div class="pb-tag">🎁 Promo Member</div><div class="pb-title">Gratis ongkir untuk pesanan ≥ 50 pcs total!</div></div>
        <button class="pb-btn" onclick="sv('pesan')">Pesan Sekarang</button>
      </div>
    </div><!-- end beranda -->


    <!-- ══════════════════════════════════════════════════
         VIEW: BUAT PESANAN  (katalog + keranjang)
    ══════════════════════════════════════════════════ -->
    <div class="view" id="view-pesan">

      <!-- STEP 1 & 2: Katalog + Keranjang -->
      <div id="step-catalog">
        <div class="pesan-layout">

          <!-- Katalog -->
          <div class="catalog-wrap">
            <div class="catalog-header">
              <div class="catalog-title">Pilih Menu</div>
              <div class="cat-tabs">
                <button class="cat-tab on" onclick="filterCat('semua',this)">Semua</button>
                <button class="cat-tab" onclick="filterCat('snack',this)">Snack</button>
                <button class="cat-tab" onclick="filterCat('catering',this)">Catering</button>
                <button class="cat-tab" onclick="filterCat('dessert',this)">Dessert</button>
              </div>
            </div>
            <div class="catalog-grid" id="catalogGrid">
              <!-- Dirender via JS -->
            </div>
          </div>

          <!-- Keranjang -->
          <div class="cart-panel">
            <div class="cart-hd">
              <div class="cart-hd-title">🛒 Keranjang <span class="cart-count-badge" id="cartBadge">0</span></div>
              <button class="cart-clear" onclick="clearCart()">Kosongkan</button>
            </div>
            <div id="cartBody">
              <div class="cart-empty"><span>🧺</span><p>Keranjang masih kosong.<br>Pilih menu di sebelah kiri.</p></div>
            </div>
            <div class="cart-summary" id="cartSummary" style="display:none;">
              <div class="cs-row"><span>Subtotal (<span id="totalQty">0</span> item)</span><span id="subtotalVal">Rp 0</span></div>
              <div class="cs-row"><span>Ongkos Kirim <span id="ongkirTag"></span></span><span id="ongkirVal">Rp 10.000</span></div>
              <div class="cs-row grand"><span>Total Pembayaran</span><span id="grandTotalVal">Rp 0</span></div>
              <button class="checkout-btn" id="checkoutBtn" onclick="goToCheckout()">
                Lanjut ke Checkout →
              </button>
            </div>
          </div>

        </div>
      </div><!-- end step-catalog -->

      <!-- STEP 3 & 4: Detail + Konfirmasi -->
      <div id="step-checkout" style="display:none;">
        <div class="flow-wrap">
          <div class="flow-steps">
            <div class="fs on" id="fs2"><span class="fs-num">2</span>Detail Pesanan</div>
            <div class="fs"    id="fs3"><span class="fs-num">3</span>Konfirmasi</div>
          </div>

          <!-- Panel: Detail -->
          <div class="flow-panel show" id="panel-detail">
            <h3 style="font-family:var(--serif);font-size:1.05rem;color:var(--dark);margin-bottom:0.35rem;">Detail &amp; Pengiriman</h3>
            <p style="font-size:0.78rem;color:var(--muted);margin-bottom:1.3rem;">Lengkapi informasi acara dan pengiriman untuk semua item dalam keranjang.</p>

            <!-- Ringkasan keranjang mini -->
            <div style="background:var(--beige);border:1px solid var(--tan);border-radius:5px;padding:0.85rem 1rem;margin-bottom:1.3rem;" id="checkoutCartMini"></div>

            <div class="frow2">
              <div class="fgroup">
                <label class="flabel">Jenis Acara</label>
                <select id="f-acara" class="fselect">
                  <option value="">Pilih jenis acara...</option>
                  <option>Arisan / Pertemuan</option><option>Hajatan / Syukuran</option>
                  <option>Ulang Tahun</option><option>Meeting / Kantor</option>
                  <option>Sekolah / Kampus</option><option>Lainnya</option>
                </select>
                <div class="err-msg" id="e-acara">Pilih jenis acara</div>
              </div>
              <div class="fgroup">
                <label class="flabel">Tanggal Acara</label>
                <input id="f-tgl" type="date" class="finput">
                <div class="err-msg" id="e-tgl">Pilih tanggal acara</div>
              </div>
            </div>
            <div class="frow2">
              <div class="fgroup">
                <label class="flabel">Waktu Pengiriman</label>
                <select id="f-waktu" class="fselect">
                  <option value="">Pilih waktu...</option>
                  <option>07.00 – 09.00 WIB</option><option>09.00 – 11.00 WIB</option>
                  <option>11.00 – 13.00 WIB</option><option>13.00 – 15.00 WIB</option>
                  <option>15.00 – 17.00 WIB</option>
                </select>
                <div class="err-msg" id="e-waktu">Pilih waktu pengiriman</div>
              </div>
              <div class="fgroup">
                <label class="flabel">Metode Pembayaran</label>
                <select id="f-bayar" class="fselect">
                  <option value="">Pilih metode...</option>
                  <option>Transfer Bank (BCA)</option><option>Transfer Bank (Mandiri)</option>
                  <option>QRIS / GoPay / OVO</option><option>Bayar di Tempat (COD)</option>
                </select>
                <div class="err-msg" id="e-bayar">Pilih metode pembayaran</div>
              </div>
            </div>
            <div class="fgroup">
              <label class="flabel">Alamat Pengiriman</label>
              <input id="f-alamat" type="text" class="finput" placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota">
              <div class="err-msg" id="e-alamat">Masukkan alamat lengkap</div>
            </div>
            <div class="fgroup">
              <label class="flabel">Catatan Tambahan (opsional)</label>
              <textarea id="f-note" class="ftarea" placeholder="Contoh: tidak pakai sambal, minta dibungkus terpisah per menu, dll..."></textarea>
            </div>
            <div class="flow-nav">
              <button class="flow-back" onclick="backToCatalog()">← Kembali ke Keranjang</button>
              <button class="flow-next" onclick="goConfirm()">Lanjut: Konfirmasi →</button>
            </div>
          </div>

          <!-- Panel: Konfirmasi -->
          <div class="flow-panel" id="panel-confirm">
            <h3 style="font-family:var(--serif);font-size:1.05rem;color:var(--dark);margin-bottom:0.35rem;">Konfirmasi Pesanan</h3>
            <p style="font-size:0.78rem;color:var(--muted);margin-bottom:1.3rem;">Periksa kembali seluruh pesanan sebelum dikonfirmasi.</p>

            <!-- Tabel item -->
            <div id="confirmItemsTable"></div>

            <!-- Detail pengiriman -->
            <div class="confirm-box" id="confirmDetailBox"></div>

            <div style="background:rgba(201,169,110,0.1);border:1px solid rgba(201,169,110,0.3);border-radius:5px;padding:0.85rem 1rem;margin-bottom:1rem;font-size:0.77rem;color:var(--brown);line-height:1.7;">
              <strong style="color:var(--gold-dark);">📌 Informasi Penting:</strong><br>
              Pesanan langsung masuk ke dapur kami setelah Anda konfirmasi. Admin akan memproses dan mengubah status pesanan. Pembayaran dilakukan sesuai metode yang dipilih.
            </div>

            <div class="flow-nav">
              <button class="flow-back" onclick="backToDetail()">← Ubah Detail</button>
              <button class="flow-next" id="submitBtn" onclick="submitOrder()">✦ &nbsp;Konfirmasi &amp; Kirim Pesanan</button>
            </div>
          </div>
        </div>
      </div><!-- end step-checkout -->

    </div><!-- end view-pesan -->


    <!-- ══════════════════════════════════════════════════
         VIEW: RIWAYAT
    ══════════════════════════════════════════════════ -->
    <div class="view" id="view-riwayat">
      <div class="str">
        <div class="stitle">Riwayat Pesanan</div>
        <button class="btn-sm" onclick="sv('pesan')">+ Pesanan Baru</button>
      </div>
      <div class="orders-list" id="allOrders">
        <div class="empty"><span>📋</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Mulai Pesan Sekarang</button></div>
      </div>
    </div>


    <!-- ══════════════════════════════════════════════════
         VIEW: PROFIL
    ══════════════════════════════════════════════════ -->
    <div class="view" id="view-profil">
      <div class="str"><div class="stitle">Profil Saya</div></div>
      <div class="profile-wrap">
        <div class="profile-card">
          <div class="pf-av" id="pfAv">?</div>
          <div class="pf-name" id="pfName">Pelanggan</div>
          <div class="pf-email" id="pfEmail">—</div>
          <div class="pf-stat">
            <div class="pf-stat-item"><div class="pf-stat-val" id="pfTot">0</div><div class="pf-stat-lbl">Pesanan</div></div>
            <div class="pf-stat-item"><div class="pf-stat-val" id="pfDone">0</div><div class="pf-stat-lbl">Selesai</div></div>
            <div class="pf-stat-item"><div class="pf-stat-val">5.0</div><div class="pf-stat-lbl">Rating</div></div>
          </div>
          <div class="pf-since">📅 Member sejak Mei 2025</div>
        </div>
        <div>
          <div class="profile-card">
            <div style="font-family:var(--serif);font-size:1rem;font-weight:600;color:var(--dark);margin-bottom:1.1rem;">Edit Profil</div>
            <div class="frow2">
              <div class="fgroup"><label class="flabel">Nama Lengkap</label><input type="text" class="finput" id="pf-nama" placeholder="Nama lengkap"></div>
              <div class="fgroup"><label class="flabel">No. WhatsApp</label><input type="tel" class="finput" placeholder="08xx-xxxx-xxxx"></div>
            </div>
            <div class="fgroup"><label class="flabel">Email</label><input type="email" class="finput" id="pf-email-input" placeholder="email@contoh.com"></div>
            <div class="fgroup"><label class="flabel">Alamat Default</label><input type="text" class="finput" id="pf-alamat-def" placeholder="Jl. Rumah No. 1, Surabaya"></div>
            <div class="fgroup"><label class="flabel">Password Baru (kosongkan jika tidak diubah)</label><input type="password" class="finput" placeholder="••••••••"></div>
            <button class="flow-next" onclick="saveProfil(event)" style="width:100%;margin-top:0.5rem;">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

  </div><!-- end content -->
</div><!-- end main -->


<!-- ══ MODAL: SUKSES ════════════════════════════════════════ -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <div class="modal-icon">✓</div>
    <div class="modal-title">Pesanan Terkirim!</div>
    <div class="modal-sub">Semua item dalam pesanan Anda sudah masuk ke dapur kami dan sedang menunggu konfirmasi admin.</div>
    <div class="modal-id" id="modalOrderId">#ORD-0000</div>
    <div class="modal-items" id="modalItemsList"></div>
    <div class="modal-steps">
      <div class="mstep"><div class="mstep-n">1</div><span><strong>Pesanan Diterima</strong> — Admin kami akan segera memproses pesanan Anda</span></div>
      <div class="mstep"><div class="mstep-n">2</div><span><strong>Status Terupdate</strong> — Pantau perkembangan di Riwayat Pesanan</span></div>
      <div class="mstep"><div class="mstep-n">3</div><span><strong>Dikirim Tepat Waktu</strong> — Pesanan fresh dikirim sesuai jadwal</span></div>
    </div>
    <div class="modal-btn-row">
      <button class="modal-btn secondary" onclick="closeModal()">Tutup</button>
      <button class="modal-btn primary" onclick="closeModal();sv('riwayat')">Lihat Riwayat →</button>
    </div>
  </div>
</div>

<!-- ══ DRAWER: DETAIL PESANAN ════════════════════════════════ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer(event)">
  <div class="drawer" id="drawerPanel">
    <div class="drawer-close" onclick="closeDrawer()">✕</div>
    <div class="drawer-title">Detail Pesanan</div>
    <div id="drawerContent"></div>
  </div>
</div>


<!-- ══════════════════════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════════════════════ -->
<script>
/* ── USER INFO ──────────────────────────────────────────── */
const mName  = sessionStorage.getItem('member_name')  || 'Pelanggan';
const mEmail = sessionStorage.getItem('member_email') || 'pelanggan@email.com';
const mPhone = <?= json_encode($user['no_hp'] ?? '') ?>;
const mInit  = mName.trim().charAt(0).toUpperCase();
['sbAv','pfAv'].forEach(id => { const el=document.getElementById(id); if(el) el.textContent=mInit; });
['sbName','wbName','pfName'].forEach(id => { const el=document.getElementById(id); if(el) el.textContent=mName; });
['pfEmail'].forEach(id => { const el=document.getElementById(id); if(el) el.textContent=mEmail; });
document.getElementById('pf-nama').value        = mName;
document.getElementById('pf-email-input').value = mEmail;

/* ── KATALOG DATA ───────────────────────────────────────── */
const MENU = [
  {id:'m1', name:'Risol Mayo Spesial',      cat:'snack',    price:3500,    unit:'pcs',  img:'https://i.pinimg.com/1200x/5e/3d/51/5e3d51622e72eb06fbb39fe89a769086.jpg', badge:'Bestseller'},
  {id:'m2', name:'Onde-onde Kacang Hijau',  cat:'snack',    price:3000,    unit:'pcs',  img:'https://i.pinimg.com/736x/9c/3a/0f/9c3a0f6cfdae3d8d2bbe13f6e4231c49.jpg'},
  {id:'m3', name:'Sosis Solo Ayam',          cat:'snack',    price:4000,    unit:'pcs',  img:'https://i.pinimg.com/1200x/37/63/7f/37637f82ed9ecb1843e4873b48a7409f.jpg', badge:'Favorit'},
  {id:'m4', name:'Pastel Bihun',             cat:'snack',    price:3500,    unit:'pcs',  img:'https://i.pinimg.com/1200x/3c/50/f4/3c50f40040ff51e3ad12bc36ae1ea275.jpg'},
  {id:'m5', name:'Nasi Kotak Premium',       cat:'catering', price:35000,   unit:'box',  img:'https://i.pinimg.com/1200x/f6/2b/67/f62b67ac108f21e3dcf1780318d1c8a6.jpg', badge:'Popular'},
  {id:'m6', name:'Snack Box Arisan',         cat:'catering', price:25000,   unit:'box',  img:'https://i.pinimg.com/1200x/c0/fe/92/c0fe92c0990dc62eb773d4cddd9d406f.jpg'},
  {id:'m7', name:'Paket Catering 50 Orang',  cat:'catering', price:1500000, unit:'paket',img:'https://i.pinimg.com/1200x/8f/53/bf/8f53bf58d1d2935bf50381bd20189413.jpg', badge:'Hemat'},
  {id:'m8', name:'Donat Premium',            cat:'dessert',  price:6000,    unit:'pcs',  img:'https://i.pinimg.com/736x/ce/c0/a9/cec0a9788d0e997e27414f6b1ad1b305.jpg', badge:'New!'},
  {id:'m9', name:'Kue Lapis Legit',          cat:'dessert',  price:8000,    unit:'slice',img:'https://i.pinimg.com/736x/0a/84/81/0a8481457164672038116e4d325f16c2.jpg'},
  {id:'m10',name:'Paket Hantaran',           cat:'dessert',  price:80000,   unit:'box',  img:'https://i.pinimg.com/1200x/1d/bd/0c/1dbd0cedea4cb0c8ced60935e9826616.jpg'},
  {id:'m11',name:'Mochi Matcha',             cat:'dessert',  price:5000,    unit:'pcs',  img:'https://i.pinimg.com/1200x/30/60/5a/30605a5ebd32c77defc2888c548b42ed.jpg'},
];

/* ── CART STATE ─────────────────────────────────────────── */
// cart = { [menuId]: qty }
let cart = {};
let currentCatFilter = 'semua';

/* ── RENDER CATALOG ─────────────────────────────────────── */
function renderCatalog(filter='semua') {
  const grid = document.getElementById('catalogGrid');
  const items = filter==='semua' ? MENU : MENU.filter(m=>m.cat===filter);
  grid.innerHTML = items.map(m => {
    const inCart = cart[m.id] || 0;
    return `<div class="menu-card" id="card-${m.id}">
      ${m.badge ? `<div style="position:relative;"><img src="${m.img}" alt="${m.name}"><div style="position:absolute;top:8px;left:8px;background:var(--gold);color:var(--white);font-size:0.56rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:2px 7px;border-radius:2px;">${m.badge}</div></div>` : `<img src="${m.img}" alt="${m.name}">`}
      <div class="mc-body">
        <div class="mc-cat">${m.cat}</div>
        <div class="mc-name">${m.name}</div>
        <div class="mc-price">Rp ${m.price.toLocaleString('id-ID')} / ${m.unit}</div>
        <div class="mc-action">
          <div class="qty-ctrl">
            <button class="qb" onclick="catalogQty('${m.id}',-1)">−</button>
            <div class="qn" id="cq-${m.id}">${inCart}</div>
            <button class="qb" onclick="catalogQty('${m.id}',1)">+</button>
          </div>
          <button class="add-btn ${inCart>0?'in-cart':''}" id="addbtn-${m.id}" onclick="addToCart('${m.id}')">
            ${inCart>0 ? '✓ Ditambah' : '+ Tambah'}
          </button>
        </div>
      </div>
    </div>`;
  }).join('');
}

function filterCat(cat, btn) {
  currentCatFilter = cat;
  document.querySelectorAll('.cat-tab').forEach(t=>t.classList.remove('on'));
  btn.classList.add('on');
  renderCatalog(cat);
}

/* ── CART OPERATIONS ────────────────────────────────────── */
function catalogQty(id, delta) {
  const cur = cart[id] || 0;
  const nv  = Math.max(0, cur + delta);
  if(nv === 0) { delete cart[id]; } else { cart[id] = nv; }
  // Update display in catalog
  const qnEl = document.getElementById('cq-'+id);
  if(qnEl) qnEl.textContent = nv;
  const btnEl = document.getElementById('addbtn-'+id);
  if(btnEl) { btnEl.textContent = nv>0 ? '✓ Ditambah' : '+ Tambah'; btnEl.classList.toggle('in-cart', nv>0); }
  renderCart();
}

function addToCart(id) {
  cart[id] = (cart[id]||0) + 1;
  const qnEl = document.getElementById('cq-'+id);
  if(qnEl) qnEl.textContent = cart[id];
  const btnEl = document.getElementById('addbtn-'+id);
  if(btnEl) { btnEl.textContent = '✓ Ditambah'; btnEl.classList.add('in-cart'); }
  renderCart();
  // Bounce animation on cart badge
  const badge = document.getElementById('cartBadge');
  badge.style.transform='scale(1.4)';
  setTimeout(()=>badge.style.transform='',220);
}

function cartRemove(id) {
  delete cart[id];
  renderCatalog(currentCatFilter);
  renderCart();
}
function clearCart() {
  if(Object.keys(cart).length===0) return;
  if(!confirm('Kosongkan semua item dari keranjang?')) return;
  cart = {};
  renderCatalog(currentCatFilter);
  renderCart();
}

/* ── RENDER CART PANEL ──────────────────────────────────── */
function renderCart() {
  const ids    = Object.keys(cart);
  const total  = ids.reduce((s,id)=>{ const m=MENU.find(x=>x.id===id); return s+(m?m.price*cart[id]:0); }, 0);
  const totalQ = ids.reduce((s,id)=>s+cart[id], 0);
  const ongkir = totalQ >= 50 ? 0 : 10000;
  const grand  = total + ongkir;

  // Badges
  const showBadge = ids.length > 0;
  ['cartBadge','cartBadgeSb'].forEach(bid=>{ const b=document.getElementById(bid); if(b){b.textContent=totalQ;b.style.display=showBadge?'':'none';}});
  const top = document.getElementById('cartCountTop'); if(top){top.textContent=totalQ;top.style.display=showBadge?'':'none';}

  if(ids.length === 0) {
    document.getElementById('cartBody').innerHTML = `<div class="cart-empty"><span>🧺</span><p>Keranjang masih kosong.<br>Pilih menu di sebelah kiri.</p></div>`;
    document.getElementById('cartSummary').style.display = 'none';
    return;
  }

  document.getElementById('cartBody').innerHTML = `<div class="cart-items">${
    ids.map(id => {
      const m = MENU.find(x=>x.id===id);
      if(!m) return '';
      return `<div class="cart-item">
        <img class="ci-img" src="${m.img}" alt="${m.name}">
        <div class="ci-info">
          <div class="ci-name">${m.name}</div>
          <div class="ci-price">Rp ${m.price.toLocaleString('id-ID')} / ${m.unit}</div>
        </div>
        <div class="ci-qty">
          <button class="cqb" onclick="catalogQty('${id}',-1)">−</button>
          <div class="cqn">${cart[id]}</div>
          <button class="cqb" onclick="catalogQty('${id}',1)">+</button>
        </div>
        <div class="ci-sub">Rp ${(m.price*cart[id]).toLocaleString('id-ID')}</div>
        <button class="ci-del" onclick="cartRemove('${id}')" title="Hapus">✕</button>
      </div>`;
    }).join('')
  }</div>`;

  document.getElementById('totalQty').textContent   = totalQ;
  document.getElementById('subtotalVal').textContent = 'Rp '+total.toLocaleString('id-ID');
  const ongTag = document.getElementById('ongkirTag');
  if(ongkir===0){ ongTag.innerHTML='<span class="promo-tag">GRATIS ≥50 pcs</span>'; document.getElementById('ongkirVal').textContent='Rp 0';}
  else { ongTag.innerHTML=''; document.getElementById('ongkirVal').textContent='Rp '+ongkir.toLocaleString('id-ID'); }
  document.getElementById('grandTotalVal').textContent = 'Rp '+grand.toLocaleString('id-ID');
  document.getElementById('cartSummary').style.display = 'block';
}

/* ── CHECKOUT FLOW ──────────────────────────────────────── */
function goToCheckout() {
  if(Object.keys(cart).length === 0) { alert('Keranjang masih kosong!'); return; }
  // Render mini cart summary
  const ids = Object.keys(cart);
  const total = ids.reduce((s,id)=>{ const m=MENU.find(x=>x.id===id); return s+(m?m.price*cart[id]:0); }, 0);
  const totalQ = ids.reduce((s,id)=>s+cart[id], 0);
  document.getElementById('checkoutCartMini').innerHTML =
    `<div style="font-size:0.71rem;font-weight:600;color:var(--muted);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.6rem;">Ringkasan Keranjang (${ids.length} menu, ${totalQ} item)</div>` +
    ids.map(id=>{ const m=MENU.find(x=>x.id===id); if(!m) return '';
      return `<div style="display:flex;align-items:center;gap:0.6rem;padding:0.3rem 0;font-size:0.78rem;color:var(--dark);">
        <img src="${m.img}" style="width:28px;height:28px;border-radius:3px;object-fit:cover;">
        <span style="flex:1;">${m.name}</span>
        <span style="color:var(--muted);">× ${cart[id]}</span>
        <span style="font-weight:600;color:var(--gold-dark);">Rp ${(m.price*cart[id]).toLocaleString('id-ID')}</span>
      </div>`;
    }).join('') +
    `<div style="font-size:0.82rem;font-weight:700;color:var(--dark);border-top:1px solid var(--tan);padding-top:0.5rem;margin-top:0.35rem;text-align:right;">Total: Rp ${total.toLocaleString('id-ID')}</div>`;

  document.getElementById('step-catalog').style.display  = 'none';
  document.getElementById('step-checkout').style.display = 'block';
  showFlowPanel('detail');
  window.scrollTo({top:0,behavior:'smooth'});
}

function backToCatalog() {
  document.getElementById('step-checkout').style.display = 'none';
  document.getElementById('step-catalog').style.display  = 'block';
  window.scrollTo({top:0,behavior:'smooth'});
}
function backToDetail() { showFlowPanel('detail'); }

function showFlowPanel(which) {
  document.querySelectorAll('.flow-panel').forEach(p=>p.classList.remove('show'));
  document.getElementById('panel-'+which).classList.add('show');
  ['fs2','fs3'].forEach(id=>document.getElementById(id).classList.remove('on','done'));
  if(which==='detail') { document.getElementById('fs2').classList.add('on'); }
  if(which==='confirm'){ document.getElementById('fs2').classList.add('done'); document.getElementById('fs3').classList.add('on'); }
}

function goConfirm() {
  // Validate
  let ok = true;
  const checks = [['f-acara','e-acara'],['f-tgl','e-tgl'],['f-waktu','e-waktu'],['f-bayar','e-bayar'],['f-alamat','e-alamat']];
  checks.forEach(([fid,eid])=>{
    const el=document.getElementById(fid), em=document.getElementById(eid);
    if(!el.value.trim()){el.classList.add('err');em.style.display='block';ok=false;}
    else{el.classList.remove('err');em.style.display='none';}
  });
  if(!ok) return;
  buildConfirmView();
  showFlowPanel('confirm');
  window.scrollTo({top:0,behavior:'smooth'});
}

function buildConfirmView() {
  const ids    = Object.keys(cart);
  const total  = ids.reduce((s,id)=>{ const m=MENU.find(x=>x.id===id); return s+(m?m.price*cart[id]:0); }, 0);
  const totalQ = ids.reduce((s,id)=>s+cart[id], 0);
  const ongkir = totalQ >= 50 ? 0 : 10000;
  const grand  = total + ongkir;

  document.getElementById('confirmItemsTable').innerHTML = `
    <table class="oi-table">
      <thead><tr><th>Menu</th><th>Harga Satuan</th><th>Jml</th><th>Subtotal</th></tr></thead>
      <tbody>
        ${ids.map(id=>{ const m=MENU.find(x=>x.id===id); if(!m) return '';
          return `<tr>
            <td><div style="display:flex;align-items:center;gap:0.6rem;">
              <img src="${m.img}" style="width:36px;height:36px;border-radius:3px;object-fit:cover;">
              <span style="font-weight:600;">${m.name}</span></div></td>
            <td>Rp ${m.price.toLocaleString('id-ID')}</td>
            <td>${cart[id]} ${m.unit}</td>
            <td style="font-weight:600;color:var(--gold-dark);">Rp ${(m.price*cart[id]).toLocaleString('id-ID')}</td>
          </tr>`;
        }).join('')}
        <tr class="total-row"><td colspan="3">Ongkos Kirim ${totalQ>=50?'<span style="color:var(--green);font-size:0.7rem;">(GRATIS)</span>':''}</td><td>Rp ${ongkir.toLocaleString('id-ID')}</td></tr>
        <tr class="total-row"><td colspan="3" style="color:var(--dark);font-size:0.92rem;">TOTAL PEMBAYARAN</td><td style="color:var(--gold-dark);font-size:1rem;">Rp ${grand.toLocaleString('id-ID')}</td></tr>
      </tbody>
    </table>`;

  document.getElementById('confirmDetailBox').innerHTML = `
    <div class="cb-row"><span>Jenis Acara</span><span>${document.getElementById('f-acara').value}</span></div>
    <div class="cb-row"><span>Tanggal Acara</span><span>${formatDate(document.getElementById('f-tgl').value)}</span></div>
    <div class="cb-row"><span>Waktu Pengiriman</span><span>${document.getElementById('f-waktu').value}</span></div>
    <div class="cb-row"><span>Metode Pembayaran</span><span>${document.getElementById('f-bayar').value}</span></div>
    <div class="cb-row"><span>Alamat</span><span style="max-width:240px;text-align:right;">${document.getElementById('f-alamat').value}</span></div>
    ${document.getElementById('f-note').value ? `<div class="cb-row"><span>Catatan</span><span style="max-width:230px;text-align:right;">${document.getElementById('f-note').value}</span></div>` : ''}
    <div class="cb-row total"><span>Total Pembayaran</span><span>Rp ${grand.toLocaleString('id-ID')}</span></div>`;
}

/* ── SUBMIT ORDER ───────────────────────────────────────── */
function submitOrder() {
  const btn = document.getElementById('submitBtn');
  btn.textContent='Mengirim pesanan...'; btn.disabled=true;

  const ids    = Object.keys(cart);
  const items  = ids.map(id=>{ const m=MENU.find(x=>x.id===id); return m?{...m,qty:cart[id],subtotal:m.price*cart[id]}:null; }).filter(Boolean);
  const total  = items.reduce((s,i)=>s+i.subtotal, 0);
  const totalQ = items.reduce((s,i)=>s+i.qty, 0);
  const ongkir = totalQ >= 50 ? 0 : 10000;
  const grand  = total + ongkir;

  const payload = {
    nama:    mName,
    hp:      mPhone || '0000000000',
    alamat:  document.getElementById('f-alamat').value,
    catatan: `Acara: ${document.getElementById('f-acara').value}; Tanggal: ${document.getElementById('f-tgl').value}; Waktu: ${document.getElementById('f-waktu').value}; Bayar: ${document.getElementById('f-bayar').value}; Catatan: ${document.getElementById('f-note').value}`,
    items: items.map(i => ({
      menu_id: null,
      nama_menu: i.name,
      harga: i.price,
      qty: i.qty,
    })),
  };

  fetch('?page=member&action=buat', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      alert(data.message || 'Gagal mengirim pesanan.');
      btn.textContent='✦  Konfirmasi & Kirim Pesanan'; btn.disabled=false;
      return;
    }

    const orderId = '#ORD-' + data.pesanan_id;

    // Modal
    document.getElementById('modalOrderId').textContent = orderId;
    document.getElementById('modalItemsList').innerHTML = items.map(i=>`
      <div class="mi-row"><img src="${i.img}" alt="${i.name}"><span>${i.name} × ${i.qty} ${i.unit}</span><strong>Rp ${i.subtotal.toLocaleString('id-ID')}</strong></div>
    `).join('');
    document.getElementById('modalOverlay').classList.add('show');

    // Reset
    cart = {};
    ['f-acara','f-tgl','f-waktu','f-bayar','f-note'].forEach(id=>{const el=document.getElementById(id); if(el) el.value='';});
    if (document.getElementById('f-alamat')) document.getElementById('f-alamat').value='';
    if (document.getElementById('f-hp')) document.getElementById('f-hp').value='';
    renderCart();
    renderCatalog(currentCatFilter);
    document.getElementById('step-checkout').style.display='none';
    document.getElementById('step-catalog').style.display='block';
    btn.textContent='✦  Konfirmasi & Kirim Pesanan'; btn.disabled=false;
    renderBeranda();
  })
  .catch(() => {
    alert('Terjadi kesalahan koneksi.');
    btn.textContent='✦  Konfirmasi & Kirim Pesanan'; btn.disabled=false;
  });
}

/* ── MODAL ──────────────────────────────────────────────── */
function closeModal() { document.getElementById('modalOverlay').classList.remove('show'); }

/* ── RENDER ORDERS ──────────────────────────────────────── */
let ordersCache = [];

async function fetchOrders() {
  try {
    const res = await fetch('?page=member&action=pesanan');
    const data = await res.json();
    if (!data.success) return [];
    return data.data.map(o => ({
      id:        '#ORD-' + o.id,
      rawId:     o.id,
      items:     [],
      itemList:  o.item_list || '-',
      totalItems: (o.item_list || '').split(',').filter(Boolean).length,
      totalQty:  null,
      total:     parseFloat(o.total),
      status:    mapStatus(o.status),
      createdAt: o.created_at,
      tgl:       (o.created_at || '').slice(0,10),
      acara:     '',
      waktu:     '',
      bayar:     '',
      alamat:    '',
      note:      '',
    }));
  } catch (e) { console.error('Gagal memuat pesanan:', e); return []; }
}

// Mapping status DB -> label tampilan
function mapStatus(s) {
  const map = { 'Baru':'Menunggu Konfirmasi', 'Diproses':'Diproses', 'Selesai':'Selesai', 'Dibatalkan':'Dibatalkan' };
  return map[s] || s;
}
function statusClass(s) {
  if(s==='Selesai') return 's-selesai';
  if(['Diproses','Dimasak','Siap Kirim','Dikonfirmasi'].includes(s)) return 's-proses';
  if(s==='Dibatalkan') return 's-batal';
  return 's-new';
}

function renderOrderCard(o) {
  const sc = statusClass(o.status);
  const canCancel  = o.status==='Menunggu Konfirmasi';
  return `<div class="ocard">
    <div class="ocard-top">
      <div class="ocard-info">
        <div class="ocard-title">${o.id}</div>
        <div class="ocard-meta">${o.totalItems} item · ${o.acara||'—'}</div>
        <div><span class="sbadge ${sc}"><span class="dot-s"></span>${o.status}</span></div>
        <div class="ocard-items">
          <span style="font-size:0.7rem;color:var(--muted);margin-left:4px;">${o.itemList.length>55?o.itemList.slice(0,55)+'…':o.itemList}</span>
        </div>
      </div>
      <div class="ocard-right">
        <div class="ocard-price">Rp ${(o.total||0).toLocaleString('id-ID')}</div>
        <div class="ocard-date">${formatDate(o.tgl)}</div>
        <div class="ocard-actions">
          <button class="btn-sm btn-sm-g" style="font-size:0.62rem;padding:0.33rem 0.72rem;" onclick='openDrawer(${JSON.stringify(o).replace(/'/g,"&#39;")})'>Detail</button>
          ${canCancel?`<button class="btn-sm" style="background:rgba(231,76,60,0.1);color:var(--red);font-size:0.62rem;padding:0.33rem 0.72rem;border:none;" onclick="cancelOrder(${o.rawId})">Batalkan</button>`:''}
        </div>
      </div>
    </div>
  </div>`;
}

async function renderBeranda() {
  const orders = ordersCache.length ? ordersCache : (ordersCache = await fetchOrders());
  const selesai = orders.filter(o=>o.status==='Selesai').length;
  const proses  = orders.filter(o=>!['Selesai','Dibatalkan'].includes(o.status)).length;
  const total   = orders.reduce((s,o)=>s+(o.total||0), 0);
  document.getElementById('statTotal').textContent   = orders.length;
  document.getElementById('statSelesai').textContent = selesai;
  document.getElementById('statProses').textContent  = proses;
  document.getElementById('statBelanja').textContent = total>0 ? 'Rp '+(total/1000000).toFixed(1)+'Jt' : 'Rp 0';
  const wrap = document.getElementById('berandaOrders');
  wrap.innerHTML = orders.length===0
    ? `<div class="empty"><span>🛒</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Buat Pesanan Pertama →</button></div>`
    : orders.slice(0,3).map(o=>renderOrderCard(o)).join('');
  const waiting = orders.filter(o=>o.status==='Menunggu Konfirmasi').length;
  const nb = document.getElementById('notifBadge'); nb.textContent=waiting; nb.style.display=waiting>0?'':'none';
}

async function renderRiwayat() {
  ordersCache = await fetchOrders();
  const orders = ordersCache;
  document.getElementById('allOrders').innerHTML = orders.length===0
    ? `<div class="empty"><span>📋</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Mulai Pesan Sekarang</button></div>`
    : orders.map(o=>renderOrderCard(o)).join('');
}

/* ── CANCEL ─────────────────────────────────────────────── */
async function cancelOrder(rawId) {
  if(!confirm('Batalkan pesanan #ORD-'+rawId+'?')) return;
  try {
    const res = await fetch('?page=member&action=batalkan', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id: rawId })
    });
    const data = await res.json();
    if (!data.success) { alert(data.message || 'Gagal membatalkan pesanan.'); return; }
    ordersCache = [];
    renderRiwayat(); renderBeranda();
  } catch (e) { alert('Terjadi kesalahan koneksi.'); }
}

/* ── DRAWER ─────────────────────────────────────────────── */
function openDrawer(o) {
  const sc = statusClass(o.status);
  const steps = ['Menunggu Konfirmasi','Diproses','Selesai'];
  const ci = Math.max(0, steps.indexOf(o.status));
  document.getElementById('drawerContent').innerHTML = `
    <div class="d-section">
      <div class="d-label">Status Pesanan</div>
      <span class="sbadge ${sc}" style="margin-bottom:0.5rem;"><span class="dot-s"></span>${o.status}</span>
      <div class="stepper">${steps.map((s,i)=>`
        <div class="step ${i<ci?'done':i===ci?'active':''}">
          <div class="step-dot">${i<ci?'✓':i+1}</div>
          <div class="step-lbl">${s}</div>
        </div>`).join('')}
      </div>
    </div>
    <div class="d-section">
      <div class="d-label">Item Pesanan</div>
      <div style="font-size:0.8rem;color:var(--dark);padding:0.5rem 0;">${o.itemList}</div>
    </div>
    <div class="d-section">
      <div class="d-label">Detail Pesanan</div>
      <div class="d-row"><span>No. Pesanan</span><span>${o.id}</span></div>
      <div class="d-row"><span>Total Pembayaran</span><span style="color:var(--gold-dark);font-size:0.9rem;">Rp ${(o.total||0).toLocaleString('id-ID')}</span></div>
      <div class="d-row"><span>Tanggal Pesan</span><span>${o.createdAt ? new Date(o.createdAt).toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric',hour:'2-digit',minute:'2-digit'}) : '-'}</span></div>
    </div>
    ${o.status==='Menunggu Konfirmasi'?`<button class="cancel-btn" onclick="cancelOrder(${o.rawId});closeDrawer()">Batalkan Pesanan Ini</button>`:''}`;
  document.getElementById('drawerOverlay').classList.add('show');
}
function closeDrawer(e) {
  if(!e||e.target===document.getElementById('drawerOverlay')) document.getElementById('drawerOverlay').classList.remove('show');
}

/* ── VIEW SWITCHER ──────────────────────────────────────── */
const VMETA = {
  beranda:['Beranda',          'Ringkasan aktivitas akun Anda'],
  pesan:  ['Buat Pesanan',     'Pilih beberapa menu sekaligus dalam satu pesanan'],
  riwayat:['Riwayat Pesanan',  'Pantau status semua pesanan Anda'],
  profil: ['Profil Saya',      'Kelola data akun Anda'],
};
function sv(id) {
  document.querySelectorAll('.view').forEach(v=>v.classList.remove('show'));
  document.querySelectorAll('.sb-nav a').forEach(a=>a.classList.remove('on'));
  document.getElementById('view-'+id).classList.add('show');
  document.querySelectorAll('.sb-nav a').forEach(a=>{ if(a.getAttribute('onclick')&&a.getAttribute('onclick').includes("'"+id+"'")) a.classList.add('on'); });
  document.getElementById('tbTitle').textContent = VMETA[id][0];
  document.getElementById('tbSub').textContent   = VMETA[id][1];
  if(id==='beranda') renderBeranda();
  if(id==='riwayat') renderRiwayat();
  if(id==='profil')  { document.getElementById('pfTot').textContent=ordersCache.length; document.getElementById('pfDone').textContent=ordersCache.filter(o=>o.status==='Selesai').length; }
  if(id==='pesan')   { renderCatalog(currentCatFilter); renderCart(); document.getElementById('step-checkout').style.display='none'; document.getElementById('step-catalog').style.display='block'; }
  window.scrollTo({top:0,behavior:'smooth'});
}

/* ── PROFIL SAVE ────────────────────────────────────────── */
function saveProfil(e) {
  const nama = document.getElementById('pf-nama').value;
  if(nama){sessionStorage.setItem('member_name',nama);['sbName','wbName','pfName'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=nama;});['sbAv','pfAv'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=nama.charAt(0).toUpperCase();});}
  const btn=e.target; btn.textContent='✓ Tersimpan!'; btn.style.background='var(--green)'; btn.style.color='#fff';
  setTimeout(()=>{btn.textContent='Simpan Perubahan';btn.style.background='';btn.style.color='';},2200);
}

/* ── UTILS ──────────────────────────────────────────────── */
function formatDate(d) {
  if(!d) return '—';
  return new Date(d+'T00:00:00').toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'});
}

// Init
renderBeranda();
renderCatalog();
renderCart();
</script>
</body>
</html>