// Pagination logic
$(document).ready(function() {
  // Calculate number of pages based on number of bookings and items per page
  var numPages = Math.ceil(<?php echo $result->num_rows; ?> / 10);

  // Generate pagination links
  var paginationHtml = '';
  for (var i = 1; i <= numPages; i++) {
    paginationHtml += '<a href="?page=' + i + '">' + i + '</a>';
  }

  // Display pagination links
  $('.pagination').html(paginationHtml);

  // Highlight active page
  var currentPage = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;
  $('.pagination a').eq(currentPage - 1).addClass('active');
});