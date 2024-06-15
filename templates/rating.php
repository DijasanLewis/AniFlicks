<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Base setup */
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
        body {
            margin: 5%; 
            text-align: center;
            background: #111;
            color: #333; 
        }
        h1 {
            font-size: 2em; 
            margin-bottom: .5rem;
        }

        /* Ratings widget */
        .rate {
            display: inline-block;
            border: 0;
        }
        /* Hide radio */
        .rate > input {
            display: none;
        }
        /* Order correctly by floating highest to the right */
        .rate > label {
            float: right;
        }
        /* The star of the show */
        .rate > label:before {
            display: inline-block;
            font-size: 1.1rem;
            padding: .3rem .2rem;
            margin: 0;
            cursor: pointer;
            font-family: FontAwesome;
            content: "\f005 "; /* full star */
        }
        /* Zero stars rating */
        .rate > label:last-child:before {
            content: "\f006 "; /* empty star outline */
        }
        /* Half star trick */
        .rate .half:before {
            content: "\f089 "; /* half star no outline */
            position: absolute;
            padding-right: 0;
        }
        /* Click + hover color */
        input:checked ~ label, /* color current and previous stars on checked */
        label:hover, label:hover ~ label { color: #73B100;  } /* color previous stars on hover */

        /* Hover highlights */
        input:checked + label:hover, input:checked ~ label:hover, /* highlight current and previous stars */
        input:checked ~ label:hover ~ label, /* highlight previous selected stars for new rating */
        label:hover ~ input:checked ~ label /* highlight previous selected stars */ { color: #A6E72D;  } 

    </style>
</head>
<body>
    <h1>Half Star Rating</h1>
    <fieldset class="rate">
        <input type="radio" id="rating10" name="rating" value="10" /><label for="rating10" title="5 stars"></label>
        <input type="radio" id="rating9" name="rating" value="9" /><label class="half" for="rating9" title="4 1/2 stars"></label>
        <input type="radio" id="rating8" name="rating" value="8" /><label for="rating8" title="4 stars"></label>
        <input type="radio" id="rating7" name="rating" value="7" /><label class="half" for="rating7" title="3 1/2 stars"></label>
        <input type="radio" id="rating6" name="rating" value="6" /><label for="rating6" title="3 stars"></label>
        <input type="radio" id="rating5" name="rating" value="5" /><label class="half" for="rating5" title="2 1/2 stars"></label>
        <input type="radio" id="rating4" name="rating" value="4" /><label for="rating4" title="2 stars"></label>
        <input type="radio" id="rating3" name="rating" value="3" /><label class="half" for="rating3" title="1 1/2 stars"></label>
        <input type="radio" id="rating2" name="rating" value="2" /><label for="rating2" title="1 star"></label>
        <input type="radio" id="rating1" name="rating" value="1" /><label class="half" for="rating1" title="1/2 star"></label>
        <input type="radio" id="rating0" name="rating" value="0" /><label for="rating0" title="No star"></label>
    </fieldset>
</body>
</html>