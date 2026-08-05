<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <style>
        @media only screen and (max-width:640px) {
            .email-wrapper {
                width: 100% !important;
            }

            .email-padding {
                padding: 15px !important;
            }

            .title {
                font-size: 28px !important;
            }
        }
    </style>

</head>


<body style="
margin:0;
padding:0;
background:#edf4f7;
font-family:Arial,Helvetica,sans-serif;
color:#061a44;
">


    <table width="100%" cellpadding="0" cellspacing="0" style="background:#edf4f7;">

        <tr>

            <td align="center" style="padding:25px 10px;">


                <table
                    class="email-wrapper"
                    width="700"
                    cellpadding="0"
                    cellspacing="0"
                    style="
                    background:#ffffff;
                    border-radius:22px;
                    overflow:hidden;
                    border:1px solid #d8e2ec;
                    box-shadow:0 14px 35px rgba(6,26,68,.12);
                    ">


                    {{-- HEADER --}}
                    <tr>

                        <td style="
                        background:#01498d;
                        padding:20px 30px;
                        border-bottom:4px solid #f3c900;
                        ">


                            <table width="100%">
                                <tr>


                                    <td width="150">

                                        <table
                                            cellpadding="0"
                                            cellspacing="0"
                                            style="
                                            background:#fff;
                                            border-radius:12px;
                                            padding:8px;
                                            ">

                                            <tr>

                                                <td>

                                                    <img
                                                        src="{{ $message->embed(public_path('images/ivetc-brand-footer.png')) }}"
                                                        style="
                                                        width:120px;
                                                        display:block;
                                                        ">

                                                </td>

                                            </tr>

                                        </table>


                                    </td>



                                    <td align="center">


                                        <div style="
                                        font-size:38px;
                                        font-weight:900;
                                        letter-spacing:3px;
                                        color:#fff;
                                        ">

                                            ETAI<span style="color:#f3c900;">RLINES</span>

                                        </div>


                                        <div style="
                                        color:white;
                                        font-size:12px;
                                        letter-spacing:3px;
                                        font-weight:bold;
                                        margin-top:8px;
                                        ">

                                            TU FUTURO, NUESTRO DESTINO

                                        </div>


                                    </td>



                                    <td width="60"
                                        style="
                                        font-size:40px;
                                        color:white;
                                        ">

                                        ✈

                                    </td>


                                </tr>
                            </table>


                        </td>

                    </tr>



                    {{-- BODY --}}

                    <tr>

                        <td style="padding:35px;">


                            <h1
                                class="title"
                                style="
                                margin:0;
                                font-size:36px;
                                font-weight:900;
                                color:#061a44;
                                ">

                                {{ $subject }}

                            </h1>


                            <div style="
                            height:4px;
                            width:80px;
                            background:#00833e;
                            margin:15px 0 25px;
                            ">
                            </div>



                            <div style="
                                font-size:16px;
                                line-height:1.7;
                                color:#333;
                                background:#f7fafc;
                                border-left:5px solid #00833e;
                                padding:20px;
                                border-radius:12px;
                                ">


                                {!! nl2br(e($messageText)) !!}


                            </div>



                            {{-- CTA --}}

                            <div style="
                                text-align:center;
                                margin-top:30px;
                                ">


                                <a href="https://wa.me/50663252828"
                                    style="
                                    display:inline-block;
                                    background:#00833e;
                                    color:white;
                                    text-decoration:none;
                                    padding:14px 35px;
                                    border-radius:14px;
                                    font-weight:900;
                                    font-size:15px;
                                    ">

                                    Consultar por WhatsApp

                                </a>


                            </div>



                        </td>

                    </tr>



                    {{-- FOOTER --}}

                    <tr>

                        <td style="
                            background:#061a44;
                            color:white;
                            padding:20px;
                            text-align:center;
                            border-radius:0 0 22px 22px;
                            ">


                            <div style="
                                font-size:18px;
                                font-family:Georgia,serif;
                                font-style:italic;
                                ">

                                Cada destino te acerca más a tus sueños ✈

                            </div>


                            <div style="
                                margin-top:12px;
                                font-size:13px;
                                color:#f3c900;
                                font-weight:bold;
                                ">

                                Equipo ETAIRLINES

                            </div>


                        </td>

                    </tr>



                </table>


            </td>

        </tr>

    </table>


</body>

</html>