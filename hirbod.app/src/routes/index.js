import React, { lazy, Suspense, useMemo, useState } from "react";
import {
    BrowserRouter as Router,
    Redirect,
    Route,
    Switch,
} from "react-router-dom";

import { ABOUT, CONTACT, HOME, COURSES, PODCASTS, PLUS, BOOKS, EVENTS, COURSE_DETAIL, PODCAST_DETAIL } from "../common/commonUrls";


import Home from './../views/Home';
import AboutPage from './../views/AboutPage';
import CoursesPage from '../views/CoursesPage';
import PodcastsPage from '../views/PodcastsPage';

import CourseDetailPage from '../views/CoursesPage/CourseDetailPage';
import PodcastDetailPage from '../views/PodcastsPage/PodcastDetailPage';

import NotFound from "./../views/NotFound";
import { CategoryProvider } from "../context";
import allRoute from "./allRoute";
// import Breadcrumbs from "../components/BreadCrump";

export default function Routes() {

    const [ home, setHome ] = useState([]);
    const [ categories, setCategories ] = useState([]);
    const [ tags, setTags ] = useState([]);
    const [ courses, setCourses ] = useState([]);
    const [ podcasts, setPodcasts ] = useState([]);
    const [ books, setBooks ] = useState([]);
    const [ events, setEvents ] = useState([]);
    const [ page, setPage ] = useState(1);
    const [ crumbs, setCrumbs ] = useState([]);


    const memoizedValue = useMemo(
        () => ({
            home,
            setHome,
            categories,
            setCategories,
            tags,
            setTags,
            courses,
            setCourses,
            podcasts,
            setPodcasts,
            books,
            setBooks,
            events,
            setEvents,
            page,
            setPage,
            crumbs,
            setCrumbs
        }),
        [ home, categories, tags, courses, podcasts, books, events, page, ]
    );

    return (
        <CategoryProvider value={memoizedValue}>
            <Router>
                <Switch>
                    {/* <Route exact path={HOME} component={Home} />
                    <Route exact path={COURSES} component={CoursesPage} />
                    <Route exact path={PODCASTS} component={PodcastsPage} />
                    <Route exact path={COURSE_DETAIL} component={CourseDetailPage} />
                    <Route exact path={PODCAST_DETAIL} component={PodcastDetailPage} />
                    <Route exact path={BOOKS} component={Home} />
                    <Route exact path={EVENTS} component={Home} />
                    <Route exact path={ABOUT} component={AboutPage} />
                    <Route path="/not-found" component={NotFound} />

                    <Redirect to="/not-found" /> */}
                    {allRoute.map(({ path, name, Component }, key) => (
                        <Route
                            exact
                            path={path}
                            key={key}
                            render={props => {
                                const crumbs = allRoute
                                    // Get all routes that contain the current one.
                                    .filter(({ path }) => props.match.path.includes(path))
                                    // Swap out any dynamic routes with their param values.
                                    // E.g. "/pizza/:pizzaId" will become "/pizza/1"
                                    .map(({ path, ...rest }) => ({
                                        path: Object.keys(props.match.params).length
                                            ? Object.keys(props.match.params).reduce(
                                                (path, param) =>
                                                    path.replace(`:${param}`, props.match.params[ param ]),
                                                path
                                            )
                                            : path,
                                        ...rest
                                    }));
                                // setCrumbs(crumbs)

                                // console.log(`Generated crumbs for ${props.match.path}`);
                                crumbs.map(({ name, path }) => console.log({ name, path }));

                                return (
                                    <div className="p-8">
                                        {/* <Breadcrumbs crumbs={crumbs} /> */}
                                        <Component {...props} crumbs={crumbs} />
                                    </div>
                                );
                            }}
                        />
                    ))}
                    <Redirect to="/not-found" />
                </Switch>
            </Router>
        </CategoryProvider>
    );
}
