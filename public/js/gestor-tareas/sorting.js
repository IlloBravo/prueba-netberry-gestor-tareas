let currentSort = { column: "id", order: "desc" };

export function sortTasks(tasks) {
    return [...tasks].sort((a, b) => {
        let valA = a[currentSort.column];
        let valB = b[currentSort.column];

        if (currentSort.column === "categories") {
            valA = a.categories.map(cat => cat.name).join(", ");
            valB = b.categories.map(cat => cat.name).join(", ");
        }

        if (valA < valB) return currentSort.order === "asc" ? -1 : 1;
        if (valA > valB) return currentSort.order === "asc" ? 1 : -1;
        return 0;
    });
}

export function setupSorting(renderCallback) {
    $("th[data-sort]").on("click", function () {
        let column = $(this).data("sort");
        currentSort.order = (currentSort.column === column && currentSort.order === "asc") ? "desc" : "asc";
        currentSort.column = column;
        renderCallback();
    });
}
