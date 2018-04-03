import {AfterViewInit, Component, OnChanges, OnInit, SimpleChanges} from '@angular/core';
import {HttpService} from '../../../../Service/HttpService';
import {ActivatedRoute, NavigationEnd, Router} from '@angular/router';

@Component({
  selector: 'app-show-timetable',
  templateUrl: './show-timetable.component.html',
  styleUrls: ['./show-timetable.component.scss']
})
export class ShowTimetableComponent implements OnInit, AfterViewInit, OnChanges {
  semaine: any = 1;
  timeTable: any = {
    '1' : [],
    '2' : [],
    '3' : [],
    '4' : [],
    '5' : [],
    '6' : [],
    '7' : [],
    '8' : [],
    '9' : [],
    '10' : [],
    '11' : [],
    '12' : [],
    '13' : [],
    '14' : [],
    '15' : [],
    '16' : [],
    '17' : [],
    '18' : [],
    '19' : [],
    '20' : [],
    '21' : [],
    '22' : [],
    '23' : [],
    '24' : [],
    '25' : [],
    '26' : [],
    '27' : [],
    '28' : [],
  };
  user: any;
  schedules = $('.cd-schedule');
  // objSchedulesPlan = [];
  windowResize = false;
  element = $('.cd-schedule');
  timeline = this.element.find('.timeline');
  timelineItems = this.timeline.find('li');
  timelineItemsNumber = this.timelineItems.length;
  timelineStart = this.getScheduconstimestamp(this.timelineItems.eq(0).text());
  timelineUnitDuration = this.getScheduconstimestamp(
    this.timelineItems.eq(1).text()) - this.getScheduconstimestamp(this.timelineItems.eq(0).text()
  );
  eventsWrapper = this.element.find('.events');
  eventsGroup = this.eventsWrapper.find('.events-group');
  singleEvents = this.eventsGroup.find('.single-event');
  eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight();
  transitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';
  transitionsSupported = ( $('.csstransitions').length > 0 );
  constructor(private activatedRoute: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    this.router.routeReuseStrategy.shouldReuseRoute = function(){
      return false;
    };
    this.router.events.subscribe((evt) => {
      if (evt instanceof NavigationEnd) {
        // trick the Router into believing it's last link wasn't previously loaded
        this.router.navigated = false;
        // if you need to scroll back to top, here is the right place
        window.scrollTo(0, 0);
      }
    });
    this.activatedRoute.queryParams.subscribe(params => {
      console.log(params['s']);
      if (params['s'] !== undefined) {
        this.semaine = Number(params['s']);
        if (this.semaine < 1 || this.semaine > 4) {
          this.semaine = 1;
        }
      }else {
        this.semaine = 1;
      }
    });

    this.httpService.getTimeTable(this.user.id).subscribe(
      data => {
        for (const c of data['data']) {
          this.timeTable[c['jour']].push(c);
        }
        setTimeout(() => this.loadTimeTable(), 1000);
        console.log(this.timeTable);
      }, error => {
        console.error(error);
      }
    );
  }

  goTo(semaine) {
    this.semaine = semaine;
    this.router.navigate(['professional/timetable/show'], {queryParams : {'s': semaine}});
  }

  ngAfterViewInit() {
    console.log('ng After view');
  }
  add() {
    this.router.navigate(['../add'], {relativeTo: this.activatedRoute});
  }
  ngOnChanges(changes: SimpleChanges): void {
    console.log('changes');
    console.log(changes);
  }
  ngOnInit() {
    const that = this;
    $(window).on('resize', function() {
      console.log('resize');
      if ( !that.windowResize ) {
        console.log('resize');
        that.windowResize = true;
        setTimeout(that.checkResize(that));
      }
    });
    if ( !this.transitionsSupported ) {
      this.transitionEnd = 'noTransition';
    }
  }
  loadTimeTable() {
    const that = this;
    this.element = $('.cd-schedule');
    this.timeline = this.element.find('.timeline');
    this.timelineItems = this.timeline.find('li');
    this.timelineItemsNumber = this.timelineItems.length;
    this.timelineStart = this.getScheduconstimestamp(this.timelineItems.eq(0).text());
    this.timelineUnitDuration = this.getScheduconstimestamp(
        this.timelineItems.eq(1).text()) - this.getScheduconstimestamp(this.timelineItems.eq(0).text()
      );
    this.eventsWrapper = this.element.find('.events');
    this.eventsGroup = this.eventsWrapper.find('.events-group');
    this.singleEvents = this.eventsGroup.find('.single-event');
    this.eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight();
    this.schedules = $('.cd-schedule');

    console.log('loadTimeTable');
    if ( this.schedules.length > 0 ) {
      console.log('loadTimeTable in');
      this.schedules.each(function() {
        console.log('loadTimeTable in loop');
        that.SchedulePlan($(this));
      });
    }
  }

  SchedulePlan( element ) {
    console.log('SchedulePlan');
    this.element = element;
    this.initSchedule();
  }

  initSchedule() {
    console.log('initSchedule');
    this.scheduleReset();
    this.initEvents();
  }
  initEvents() {
    const self = this;
    console.log('initEvents');

    this.singleEvents.each(function() {
      console.log('singleEvents ... ');
      // create the .event-date element for each event
      const durationLabel = '<span class="event-date">' + $(this).data('start') + ' - ' + $(this).data('end') + '</span>';
      $(this).children('a').prepend($(durationLabel));

      $(this).on('click', 'a', function(event) {
        event.preventDefault();
      });
    });
  }
  scheduleReset() {
    console.log('scheduleReset');
    const mq = this.mq();
    if ( mq === 'desktop' && !this.element.hasClass('js-full') ) {
      console.log('desktop && js-full');
      // in this case you are on a desktop version (first load or resize from mobile)
      this.eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight();
      this.element.addClass('js-full');
      this.placeEvents();
    } else if (  mq === 'mobile' && this.element.hasClass('js-full') ) {
      // in this case you are on a mobile version (first load or resize from desktop)
      this.element.removeClass('js-full loading');
      this.eventsGroup.children('ul').add(this.singleEvents).removeAttr('style');
      this.eventsWrapper.children('.grid-line').remove();
    } else if ( mq === 'desktop') {
      this.element.removeClass('loading');
    } else {
      this.element.removeClass('loading');
    }
  }
  mq() {
    // get MQ value ('desktop' or 'mobile')
    const self = this;
    return window.getComputedStyle(<Element>this.element.get(0), '::before').getPropertyValue('content').replace(/["']/g, '');
  }
  placeEvents() {
    const self = this;
    this.singleEvents.each(function() {
      // place each event in the grid -> need to set top position and height
      const start = self.getScheduconstimestamp($(this).attr('data-start')),
        duration = self.getScheduconstimestamp($(this).attr('data-end')) - start;
      const eventTop = self.eventSlotHeight * (start - self.timelineStart) / self.timelineUnitDuration,
        eventHeight = self.eventSlotHeight * duration / self.timelineUnitDuration;

      $(this).css({
        top: (eventTop - 1)  + 'px',
        height: (eventHeight + 1) + 'px'
      });
    });

    this.element.removeClass('loading');
  }
  getScheduconstimestamp(time) {
    // accepts hh:mm format - convert hh:mm to timestamp
    time = time.replace(/ /g, '');
    const timeArray = time.split(':');
    const timeStamp = Number(timeArray[0]) * 60  +  Number(timeArray[1]);
    return timeStamp;
  }
  checkResize(ref) {
    ref.scheduleReset();
    /*this.objSchedulesPlan.forEach(function(element) {
      element.scheduleReset();
    });*/
  }

}
