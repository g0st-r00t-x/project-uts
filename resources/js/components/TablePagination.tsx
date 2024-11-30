import { Link } from "@/types";
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from "./ui/pagination";

interface TablePaginationProps {
    links: Array<Link>;
}

const TablePagination: React.FC<TablePaginationProps> = ({ links }) => {
    return (
        <Pagination>
            <PaginationContent>
                {links.map((link, index) => (
                    <PaginationItem key={index}>
                        <PaginationLink
                            href={link.url || ""}
                            isActive={link.active}
                        >
                            {link.label === "&laquo; Previous" ? (
                                <PaginationPrevious className="mr-16" />
                            ) : link.label === "Next &raquo;" ? (
                                <PaginationNext className="ml-10" />
                            ) : (
                                link.label
                            )}
                        </PaginationLink>
                    </PaginationItem>
                ))}
            </PaginationContent>
        </Pagination>
    );
};

export default TablePagination
