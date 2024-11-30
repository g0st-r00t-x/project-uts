import { Button } from "@/components/ui/button";
import { Checkbox } from "@/components/ui/checkbox";
import { Label } from "@/components/ui/label";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { TableProperties } from "lucide-react";
import { ColumnVisibility as ImportedColumnVisibility } from "@/types";

interface ColumnProperties {
    columnVisibility: ImportedColumnVisibility;
    toggleColumnVisibility: (column: keyof ImportedColumnVisibility) => void;
}

const ColumnVisibilityTable = ({
    columnVisibility,
    toggleColumnVisibility,
}: ColumnProperties) => {
    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button variant="outline" size="icon">
                    <TableProperties className="h-4 w-4" />
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-56">
                <DropdownMenuLabel>Visible Columns</DropdownMenuLabel>
                <DropdownMenuSeparator />
                {Object.keys(columnVisibility).map((column) => (
                    <DropdownMenuItem
                        key={column}
                        onSelect={(e) => e.preventDefault()}
                    >
                        <div className="flex items-center space-x-2">
                            <Checkbox
                                id={`toggle-${column}`}
                                checked={
                                    columnVisibility[
                                        column as keyof ImportedColumnVisibility
                                    ]
                                }
                                onCheckedChange={() =>
                                    toggleColumnVisibility(
                                        column as keyof ImportedColumnVisibility
                                    )
                                }
                            />
                            <Label
                                htmlFor={`toggle-${column}`}
                                className="capitalize"
                            >
                                {column}
                            </Label>
                        </div>
                    </DropdownMenuItem>
                ))}
            </DropdownMenuContent>
        </DropdownMenu>
    );
};

export default ColumnVisibilityTable;
