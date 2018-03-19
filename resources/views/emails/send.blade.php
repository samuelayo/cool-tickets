<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Cool Ticket </title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">

</head>
<style>
    html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline
    }

    article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
        display: block
    }

    body {
        line-height: 1
    }

    ol, ul {
        list-style: none
    }

    blockquote, q {
        quotes: none
    }

    blockquote:before, blockquote:after, q:before, q:after {
        content: '';
        content: none
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }
</style>
<body style="background-color:#719fd4;font-family:'futura', sans-serif;font-weight:600;">
<br>
<div class="ticket"
     style="width:400px;height:auto;background-color:white;margin-top:25px;margin-bottom:25px;margin-right:auto;margin-left:auto;position:relative;">

    <div class="title" style="padding-top:50px;padding-bottom:10px;padding-right:25px;padding-left:25px;">
        <p style="font-style:italic;font-weight:100; color: black;"> E-Ticket</p>
        <p class="cinema"
           style="color:#0055b3;font-size:19px; font-family: futura; line-height:0; font-weight: 400; text-transform:uppercase; line-height:1;">{{$event->organizer}} </p>
        <p class="movie-title"
           style="font-size:30px;font-weight:900; font-family: futura; color: black; line-height:1; text-transform:uppercase; text-wrap: normal">{{$event->title}}</p>
    </div>
    <div class="poster">
        <img src="{{url($event->image)}}" style="max-width:100%;height:auto;" alt="event img"/>
    </div>
    <div class="info" style="padding-top:15px;padding-bottom:15px;padding-right:25px;padding-left:25px;">
        <table style="width:100%;font-size:18px;margin-bottom:15px;">
            <tr style="margin-bottom:10px;">
                <th style="text-align:left;font-weight:400;text-transform:lowercase; color: black;">TICKET GRADE</th>
                <th style="text-align:left;font-weight:400;text-transform:lowercase; font-family: futura; color: black;">
                    Quantity
                </th>


            </tr>
            <tr style="margin-bottom:10px;">
                <td style="width:33%;font-size:21px; font-family: futura; color: black; text-transform: uppercase;">{{$original->name}}</td>
                <td style="color:#06d88b;width:33%;font-size:21px; font-family: futura; color: black; ">{{$ticketpurchased->qty}}</td>


            </tr>
        </table>
        <table style="width:100%;font-size:18px;margin-bottom:15px;">
            <tr style="margin-bottom:10px;">
                <th style="text-align:left;font-weight:400;text-transform:lowercase; color: black;">PRICE</th>
                <th style="text-align:left;font-weight:400;text-transform:lowercase; color: black;">DATE</th>

            </tr>
            <tr style="margin-bottom:10px;">
                <td style="width:33%;font-size:21px; font-family: futura; color: black; text-transform: uppercase;">
                    N{{number_format($ticketpurchased->total_amt)}}


                </td>
                <td style="width:33%;font-size:21px; font-family: futura; color: black; text-transform: uppercase;">
                    <?php
                    $new = explode(' ', $event->date);

                    $date = new DateTime($new[0]);

                    echo $date->format('d/m/Y');
                    ?>
                </td>

            </tr>
        </table>


        <table style="width:100%;font-size:18px;margin-bottom:15px;">
            <tr style="margin-bottom:10px;">
                <th style="text-align:left;font-weight:400;text-transform:lowercase; font-family: futura; color: black;">
                    VENUE
                </th>


            </tr>
            <tr style="margin-bottom:10px;">
                <td class="location"
                    style="width:33%;font-size:20px;font-weight:700; font-family: futura; color: black; text-transform: uppercase;">{{$event->venue}}</td>


            </tr>
        </table>

        <table style="width:100%;font-size:18px;margin-bottom:15px;">
            <tr style="margin-bottom:10px;">
                <th style="text-align:left;font-weight:400;text-transform:lowercase; color: black;">DAYS TO GO</th>

                <th style="text-align:left;font-weight:400;text-transform:lowercase; color: black;">TIME</th>
            </tr>
            <tr style="margin-bottom:10px;">
                <td class="bigger" style="width:33%;font-size:48px;font-weight:900;color:red; font-family: futura;">
                    <?php
                    $date = strtotime($event->date);
                    $diff = $date - time();//time returns current time in seconds
                    $days = floor($diff / (60 * 60 * 24));
                    echo $days;
                    ?>
                </td>

                <?php
                $new = explode(' ', $event->date);

                $date = new DateTime($new[0]);


                ?>

                <td style="width:33%;font-size:21px; font-family: futura; color: black; text-transform: uppercase;">
                    <?php echo substr($new[1], 0, -3) . ' ' . $new[2]; ?></td>
            </tr>
        </table>

    </div>
    <div class="holes-lower"
         style="position:relative;margin-top:25px;margin-bottom:0px;margin-right:25px;margin-left:25px;border-width:1px;border-style:dashed;border-color:#aaa;"></div>
    <div class="serial" style="padding-top:25px;padding-bottom:25px;padding-right:25px;padding-left:25px;">
        <img src="{{asset('uploads/' . $ticketpurchased->id . '.png')}}"/>
        <br>
        <span style="opacity: .3; color: black;">{{$ticketpurchased->id}}</span>
        <table class="barcode"
               style="width:100%;font-size:18px;border-collapse:collapse;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;">
            <tr style="margin-bottom:10px;"></tr>
        </table>
        <table class="numbers"
               style="width:100%;font-size:18px;border-collapse:collapse;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;">
            <!-- <tr style="margin-bottom:10px;" >
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >9</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >1</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >7</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >3</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >7</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >5</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >5</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >1</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >7</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >8</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >7</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >3</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >1</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >4</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >5</td>
                    <td style="width:3px;height:50px;font-size:16px;text-align:center;" >2</td>
                </tr> -->
        </table>
    </div>
</div>


<div class="ticket"
     style="background-color:transparent;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:#fff;width:400px;height:auto;margin-top:25px;margin-bottom:25px;margin-right:auto;margin-left:auto;position:relative;">
    <div class="info" style="padding-top:15px;padding-bottom:15px;padding-right:25px;padding-left:25px;">
        <table style="padding-top:1em;padding-bottom:1em;padding-right:1em;padding-left:1em;width:100%;font-size:18px;margin-bottom:15px;">
            <tr style="margin-bottom:10px;">
                <th style="font-weight:100;padding-top:1em;font-size:15px;line-height:1.2;text-align:left;text-transform:lowercase;">
                    <p style="border-bottom-width:1px;border-bottom-style:dashed;border-bottom-color:#f9f9f9;text-transform:uppercase;padding-bottom:1em;font-weight:800;letter-spacing:2px;font-size:13px;">
                        ↡ IMPORTANT </p>
                    <p style="border-bottom-width:1px;border-bottom-style:dashed;border-bottom-color:#f9f9f9;padding-top:1em;padding-bottom:1em;">
                        This mail containing this E-Ticket will serve as your evidence of payment at the venue of the
                        event and/or can be swapped with a hard copy invite at various vendor points as may be stated by
                        show organiser. </p>
                    <p style="padding-top:1em;">For inquiries, complaints and more information you can shoot us a mail
                        at </p></th>


            </tr>
            <tr style="margin-bottom:10px;">
                <td style="font-size:15px;font-weight:400;width:33%; font-family: futura; color: #ffffff">hello@coolfm.ng</td>


            </tr>
        </table>
    </div>
</div>


</body>
</html>
