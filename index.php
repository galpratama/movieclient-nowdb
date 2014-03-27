<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="codebase/skins/touch.css" type="text/css" media="screen" charset="utf-8">
        <script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <title>Layout and Resizer</title>
    </head>
    <body>
        <script>
            webix.ready(function(){
                
                var films = webix.ajax().sync().post("http://io.nowdb.net/collection/select_all", {
                    token : "532fdbe38d909e7d7b81d153",
                    project:"movieapi",
                    collection:"films" 
                },
                function(text,xml,xhr){
                    return text;
                });
            
                var datas = films.responseText;
            
                webix.ui.fullScreen();
                webix.ui({
                    rows:[
                        {
                            view:"multiview",
                            cells:[
                                {
                                    id:"films",
                                    view:"unitlist",
                                    scheme: {
                                        $sort: {
                                            by: "title",
                                            dir: "asc",
                                            as: "string"
                                        }
                                    },
                                    uniteBy: function(obj){
                                        return obj.title.substr(0,1);
                                    },
                                    template:"#title#",
                                    data:datas,
                                    select:true
                                },
                                {
                                id: "actors",
                                view: "unitlist"
                                }
                            ]
                        },
                        
                        {
                            view: "tabbar",
                            type: "iconTop",
                            multiview: true,
                            options: [
                                {id: "films", icon: "film", value: "Film"},
                                {id: "actors", icon: "plus", value: "Tambah"}
                            ]
                        }   
                    ]
                });
            }); 
        </script>

    </body>
</html>