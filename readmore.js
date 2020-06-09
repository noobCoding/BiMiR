$(document).ready(function() {
        //var showChar = 400;
        //var ellipsestext = "...";
        var moretext = "More (+)";
        var lesstext = "Less (-)";
        $('.more').each(function() {
            var content = $(this).html();

            // if(content.length > showChar) {

                // var c = content.substr(0, showChar);
                // var h = content.substr(showChar-1, content.length - showChar);

                // var html = c + '<span class="moreelipses">'+ellipsestext+'</span><span class="morecontent"><span>' + h + '</span><div class="text-center margin_top_10"><a href="" class="morelink">'+moretext+'</a></div></span>';

                // $(this).html(html);
            // }
        });

        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(".moreelipses").toggle();
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });