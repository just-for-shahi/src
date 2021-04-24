// import { Pizza, EditPizza, Toppings, AnotherRoute } from "./Components/index";
import { HOME, COURSES, PODCASTS, BOOKS, EVENTS, COURSE_DETAIL, PODCAST_DETAIL,BOOK_DETAIL,EVENT_DETAIL, ABOUT } from "../common/commonUrls";

import Home from './../views/Home';
import AboutPage from './../views/AboutPage';
import CoursesPage from '../views/CoursesPage';
import PodcastsPage from '../views/PodcastsPage';
import BooksPage from '../views/BooksPage';
import EventsPage from '../views/EventsPage';
import BookDetailPage from '../views/BooksPage/BookDetailPage';
import CourseDetailPage from '../views/CoursesPage/CourseDetailPage';
import PodcastDetailPage from '../views/PodcastsPage/PodcastDetailPage';
import EventDetailPage from '../views/EventsPage/EventDetailPage';


export default [
    { path: HOME, name: "خانه", Component: Home },
    { path: COURSES, name: "دوره های آموزشی", Component: CoursesPage },
    { path: COURSE_DETAIL, name: "مشاهده دوره", Component: CourseDetailPage },
    { path: PODCASTS, name: "پادکست ها", Component: PodcastsPage },
    { path: PODCAST_DETAIL, name: "مشاهده پادکست", Component: PodcastDetailPage },
    { path: BOOKS, name: "کتاب", Component: BooksPage },
    { path: BOOK_DETAIL, name: "مشاهده کتاب", Component: BookDetailPage },
    { path: EVENTS, name: "رویدادها", Component: EventsPage },
    { path: EVENT_DETAIL, name: "مشاهده رویداد", Component: EventDetailPage },
    { path: ABOUT, name: "داغترین ها", Component: Home },

    { path: ABOUT, name: "درباره ما", Component: AboutPage },


    {/* <Route exact path={HOME} component={Home} />
                    <Route exact path={COURSES} component={CoursesPage} />
                    <Route exact path={PODCASTS} component={PodcastsPage} />
                    <Route exact path={COURSE_DETAIL} component={CourseDetailPage} />
                    <Route exact path={PODCAST_DETAIL} component={PodcastDetailPage} />
                    <Route exact path={BOOKS} component={Home} />
                    <Route exact path={EVENTS} component={Home} />
                    <Route exact path={ABOUT} component={AboutPage} />
                    <Route path="/not-found" component={NotFound} />

                    <Redirect to="/not-found" /> */} ];