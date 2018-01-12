import {AfterViewInit, Component } from '@angular/core';

@Component({
  selector: 'app-statistics',
  templateUrl: './statistics.component.html',
  styleUrls: ['./statistics.component.scss']
})
export class StatisticsComponent implements AfterViewInit {

  constructor() { }

  ngAfterViewInit() {
    const drawSparklines = () => {
      (<any>$('#sparklinedash')).sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
        type: 'bar',
        height: '20',
        barWidth: '3',
        resize: true,
        barSpacing: '3',
        barColor: '#4caf50',
      });
      if ($('#sparklinedash2').length > 0) {
        $('#sparklinedash2').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
          type: 'bar',
          height: '20',
          barWidth: '3',
          resize: true,
          barSpacing: '3',
          barColor: '#9675ce',
        });
      }

      if ($('#sparklinedash3').length > 0) {
        $('#sparklinedash3').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
          type: 'bar',
          height: '20',
          barWidth: '3',
          resize: true,
          barSpacing: '3',
          barColor: '#03a9f3',
        });
      }

      if ($('#sparklinedash4').length > 0) {
        $('#sparklinedash4').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
          type: 'bar',
          height: '20',
          barWidth: '3',
          resize: true,
          barSpacing: '3',
          barColor: '#f96262',
        });
      }
    };

    drawSparklines();
  }

}
