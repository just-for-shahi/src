
import { HOME, PODCASTS, BOOKS, EVENTS, COURSES } from '../common/commonUrls';

export const typeIcon = [
    { id: '01', type: 0, title: "Stories", icon: 'fa-concierge-bell', route: HOME },
    { id: '02', type: 1, title: "Slider", icon: 'fa-concierge-bell', route: HOME },
    { id: '03', type: 2, title: "رویدادهای آموزشی", icon: 'fa-bezier-curve', route: EVENTS },
    { id: '04', type: 3, title: "دوره های آموزشی", icon: 'fa-concierge-bell', route: COURSES },
    { id: '05', type: 4, title: "باهم میخوانیم", icon: 'fa-sync-alt', route: BOOKS },
    { id: '06', type: 5, title: "پادکست", icon: 'fa-window-restore', route: PODCASTS },
    { id: '07', type: 7, title: "داغ ترین ها", icon: 'fa-concierge-bell', route: HOME },

]


export const CAT_COURSES = 0
export const CAT_BOOKS = 1
export const CAT_PODCASTS = 2
export const CAT_EVENTS = 3


export const PAGE_SIZE = 9;