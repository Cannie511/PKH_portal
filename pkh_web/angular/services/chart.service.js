export class ChartService {
    constructor() {
        'ngInject';
        
    }

    get_angular_chart(series, colors, data, labels){
        let chart = {};
        chart.series = series;
        chart.colors = colors;
        chart.data   = data;
        chart.labels = labels;
        chart.options = {
            maintainAspectRatio: false,
            animation: false,
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            var value = label / 1000000;
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + 'm';
                            // return label/1000+'k';
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '1m = 1.000.000đ'
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        let label = data.datasets[tooltipItem.datasetIndex].label;
                        let value = tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + 'đ';
                        return label + ': ' + value;
                    }
                }
            }
        };
        return chart;
    }

    sort(arr){
        let index = 15;
        for(var i=0;i<arr.length;i++) {
            for(var j=i+1;j<arr.length-1;j++) {
                if (arr[i]['value']<arr[j]['value']){
                    let temp = arr[i];
                    arr[i] = arr[j];
                    arr[j] = temp;
                }
            }
        }
        let sum = 0;
        for (var i = index; i<arr.length;i++){
            sum+=arr[i]['value'];
        }
        arr = arr.slice(0,index);
        arr.push({
            'key': 'others',
            'value': sum
        })
        // $log.info('arr ', arr);
        return arr;
    }

    // Key_name: can be store, province, product name,...
    // category: 2019-01, 2019-02,..., 2019-12,...
    // data: list of object
    // param: filter of particular tab
    get_vertical(data, param,title,  category, key_name){
       
        // $log.info('draw vertical ', data);
        let arr = [];
      
        let amount = 0;
        angular.forEach(data, function(value, key) {
            
            // $log.info('value ', value[category]);

            if (value[category]){
                amount =parseInt(value[category]);
            } else {
                amount =0;
            }
            // Don't take row has key name is total
            if (value[key_name] != "Sum colunm" && value[key_name] != "Count column" && value[key_name] != "AVG column") {
                arr.push({'key':value[key_name]
                , 'value':amount });
            }
            
        });
        let dataProvider = [];
      
        // let title = '';
       
        // sort array in descending way and return 15 first highest rows.
        dataProvider =  this.sort(arr);
        // type= 1 => bar chart 
        let data1 = {
            title: title[0],
            type: 1,
            dataProvider: dataProvider
        };
        // type= 2 => bar chart 
        let data2 = {
            title: title[1],
            type: 3,
            dataProvider: dataProvider
        };

        return [data1, data2];

    }

    get_line_by_year(data,title){
        var d = new Date();
        var cur_year = d.getFullYear();
        var base_year = 2016;
        let arr = [];
      
        let amount = 0;
        for (var i=base_year; i<=cur_year; i++) {
            var category = i.toString();
            if (data[category]){
                amount =parseInt(data[category]);
            } else {
                amount =0;
            }
            arr.push({'key':category
            , 'value':amount });
        };
        var dataProvider = arr;
        let data1 = {
            title: title,
            type: 1,
            dataProvider: dataProvider
        };
        let data2 = {
            title: title,
            type: 3,
            dataProvider: dataProvider
        };

        return [data1,data2];
        
    }

    get_line_by_month(data, param ,title){
        var d = new Date();
        var cur_year = d.getFullYear();
        var base_year = moment(param.year).format('YYYY');
        let arr = [];
      
        let amount = 0;
        for (var i=1; i<13; i++) {
            var category = "";
            if (i<10){
                category   = base_year.toString()+'-0'+i.toString();
            } else {
                category   = base_year.toString()+'-'+i.toString();
            }
            if (data[category]){
                amount =parseInt(data[category]);
            } else {
                amount =0;
            }
            arr.push({'key':category
            , 'value':amount });
        };
        var dataProvider = arr;
        let data1 = {
            title: title,
            type: 1,
            dataProvider: dataProvider
        };

        let data2 = {
            title: title,
            type: 3,
            dataProvider: dataProvider
        };

        return [data1, data2];
        
    }

    // For demonstrate movement of object over time.
    get_compare(res, param, title){
        let smallItem = {};
        let data = [];
        var d = new Date();
        var cur_year = d.getFullYear();
        var min_year = cur_year -3;
        let $log = this.$log;
        for (var i=min_year; i<=cur_year; i++) {
            let sdata = []
            for (var j=0; j<13; j++) {
                sdata.push(0);
            };
            data.push(sdata);
        };

        var temp_amount = 0;
        angular.forEach(res, function(value, key) {
            temp_amount = value.sum;
            let data_type = parseInt(param['data_type']);
         
            if(data_type == 2){
                temp_amount = value.sum_1;
            }else  if(data_type == 3){
                temp_amount = value.count;
            }else  if(data_type == 4){
                temp_amount = value.avg_discount;
            }else  if(data_type == 5){
                temp_amount = value.count_1;
            }else  if(data_type == 6){
                temp_amount = value.count_2;
            }
            data[value.year-min_year][value.month] = temp_amount;
        });

        let dataProvider_3 = [];
        for (var i=min_year; i<=cur_year; i++) {  
            for (var j=1; j<13; j++) {
                dataProvider_3.push({
                    'key': j.toString()+'-'+i.toString(),
                    'value':data[i-min_year][j]
                });
            };
        };
      

        let dataProvider_1 = [];
        for (var i=1; i<13; i++) {
            smallItem = {};
            smallItem.category = i;
            for (var j=min_year; j<=cur_year; j++) {
                smallItem[j.toString()] = data[j-min_year][i];
            }
            dataProvider_1.push(smallItem);
        };
   
        let data_2 = data;
        for (var i=min_year; i<=cur_year; i++) {  
            for (var j=1; j<13; j++) {
                data_2[i-min_year][j] =  parseInt(data_2[i-min_year][j]) +  parseInt(data_2[i-min_year][j-1])
            };
        };

        let dataProvider_2 = [];
        for (var i=1; i<13; i++) {
            smallItem = {};
            smallItem.category = i;
            for (var j=min_year; j<=cur_year; j++) {
                smallItem[j.toString()] = data_2[j-min_year][i];
            }
            dataProvider_2.push(smallItem);
        };
       
        let graph = [];
        for (var i =min_year; i<=cur_year;i++){
            graph.push({
                "title":i.toString(),
                "balloonText": "[[title]]: <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 10,
                "bulletBorderColor": "#ffffff",
                "bulletBorderAlpha": 1,
                "bulletBorderThickness": 2,
                "valueField": i.toString()
              });
        }
        // $log.info('dataProvider ', dataProvider);
        // $log.info('Title ', item['Product code']);
        // var title = item["store_name"];
      
      
        return {
            1: [
                 {'dataProvider':dataProvider_1,'type':2,'title':title[0], 'graph':graph},
                 {'dataProvider':dataProvider_2,'type':2,'title':title[1], 'graph':graph},
                 {'dataProvider':dataProvider_3,'type':4,'title':title[2], 'graph':graph}
             ]
         } ;

    } 

   
}