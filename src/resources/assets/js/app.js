/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

let runningJobs = $('meta[name=astrometry_jobs_count]').attr("content");

if (runningJobs != 'undefined' && runningJobs > 0) {
    let userId = $('meta[name=user_id]').attr("content");
    Echo.private(`astrometry.${userId}`)
        .listen('.SpaceDB.Events.Astrometry.SolvedSuccessful', (e) => {
            if (window.location.href == e.site_url) {
                $('#astrometry-status').html(e.status);
                $('#astrometry-ra').html(e.ra);
                $('#astrometry-dec').html(e.dec);
                $('#astrometry-scale').html(e.scale);
                $('#astrometry-icon').removeClass();
                $('#astrometry-icon').addClass('green-text text-darken-2 small right material-icons');
                $('#astrometry-icon').html('done');
            }
            console.log('SolvedSuccessful');
            console.log(e);
            Materialize.toast(e.toast, 5000, 'success');
        })
        .listen('.SpaceDB.Events.Astrometry.SubmissionSuccessful', (e) => {
            if (window.location.href == e.site_url) {
                $('#astrometry-submission-id').html(e.submission_id);
                $('#astrometry-status').html(e.status);
            }
            console.log('SubmissionSuccessful');
            console.log(e);
            Materialize.toast(e.toast, 5000, 'success');
        })
        .listen('.SpaceDB.Events.Astrometry.DiscoveredJobId', (e) => {
            if (window.location.href == e.site_url) {
                $('#astrometry-status').html(e.status);
            }
            console.log('DiscoveredJobId');
            console.log(e);
        });
}

// Initialize elements
$(document).ready(function () {
    $('.button-collapse').sideNav();
    $('.slider').slider();
    $('.modal').modal();
    $('.chips').material_chip();
    $('select').material_select();
});