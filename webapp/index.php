<html>
<head>
    <title>
            This is a php file
    </title>
    <script src="/testjquery/vendor/jquery-1.9.0.min.js"></script>
    <script >
        function clickSubmit()
        {
            console.log("in submit");
            var pwd = document.getElementById("pwd");
            alert(pwd.checked);
            alert("in function");
            $( "#continue" ).html( "Next Step..." )
        }

    </script>
    <script>
        $(document).ready(
            function()
            {
                $("#pwd").change(
                    function (eventObject)
                    {
                        alert("in changed!");
                        var pwd = document.getElementById("pwd");
                        var disabilities = document.getElementById("disabilities");
                        var disabilitiespercentage = document.getElementById("disabilitiespercentage");
                        if (pwd.checked)
                        {
                            disabilities.disabled = false;
                            disabilitiespercentage.disabled = false;
                        }else
                        {
                            disabilities.disabled = true;
                            disabilitiespercentage.disabled = true;
                        }

                    }
                )
            }
        )
    </script>
</head>
<body>
    <form>
        <div align="center">
            <fieldset style="padding:0px 5px 5px 5px;width: 33%;" >
                <legend style="vertical-align: -100">
                    Jquery test form
                </legend>

                <div  style="padding:5px 5px 5px 5px;width:77%"  >
                    <div style="width: 100%;">
                        <div style="float:left;width:33%">
                            <label for="pwd"><span> PWD</span></label>
                            <input id = "pwd" type="checkbox" checked="true"></enter>
                        </div>

                        <div style="width:33%">
                            <label for="disabilities"><span> Disabilities</span></label>
                            <select id="disabilities">
                                <option> Visual</option>
                                <option> Locomotive</option>
                                <option> Audio </option>
                            </select>
                        </div>
                        <div style="width:33%">
                            <label for="disabilitiespercentage"><span> Disabilities</span></label>
                            <input id = "disabilitiespercentage" type="text" value="0"></enter>
                        </div>
                    </div>
                </div>
                <div style="padding:5px 5px 5px 5px;width: 100%;" >
                    <button id="continue" onclick="clickSubmit()" width="120px">Push me hard </button>
                </div>
            </fieldset>
        </div>


    </form>





</body>
<?php
echo $_SERVER['REQUEST_METHOD'];

/**
 * Created by PhpStorm.
 * User: pradeep.ck
 * Date: 5/13/2015
 * Time: 4:16 PM
 */
?>
</html>