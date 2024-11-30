import { ArrowDownUp } from "lucide-react";
import { Button } from "@/components/ui/button";

const SortableHeader: React.FC<{
    column: string;
    label: string;
    currentSort?: string;
    currentDirection?: "asc" | "desc";
    onSort: (column: string, direction: "asc" | "desc") => void;
}> = ({ column, label, currentSort, currentDirection, onSort }) => {
    const isSorted = currentSort === column;
    const nextDirection = isSorted
        ? currentDirection === "asc"
            ? "desc"
            : "asc"
        : "asc";

    return (
        <div className="flex items-center gap-2">
            <span>{label}</span>
            <Button
                variant="ghost"
                onClick={() => onSort(column, nextDirection)}
                className="flex items-center h-auto px-1 py-1"
            >
                <ArrowDownUp />
            </Button>
        </div>
    );
};

export default SortableHeader;