document.addEventListener("DOMContentLoaded", function () {
	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add("visible");
					observer.unobserve(entry.target); // biar gak dipanggil ulang
				}
			});
		},
		{
			threshold: 0.1, // ganti dari 0.3 jadi 0.1 supaya lebih sensitif di mobile
			rootMargin: "0px 0px -10% 0px", // bantu trigger lebih awal
		}
	);

	document.querySelectorAll(".fade-up").forEach((el) => observer.observe(el));
});
