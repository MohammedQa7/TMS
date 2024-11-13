
export function fomratDate(date, shortenDate = false) {
    const projectDate = new Date(date);
    if (shortenDate) {
        const options = { month: 'short', day: 'numeric' };
        return projectDate.toLocaleString('en-US', options);
    } else {
        const options = { month: 'short' };
        const month = projectDate.toLocaleString('en-US', options);
        const formattedDate = `${month}/${projectDate.getUTCDate()}/${projectDate.getUTCFullYear()}`
        return formattedDate;

    }







}