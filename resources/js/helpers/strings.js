export const escapeRegexSpecialChars = (regex) => {
    const specialChars = ['$', '^', '+', '.', '*', '?', '(', ')', '[', ']', '{', '}'];
     specialChars.forEach(specialChar => {
       regex = regex.replace(specialChar, `\\${specialChar}`);
     });
    return regex;
};